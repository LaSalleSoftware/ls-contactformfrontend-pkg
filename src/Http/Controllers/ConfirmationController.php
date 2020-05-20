<?php

/**
 * This file is part of the Lasalle Software contact form front-end package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  (c) 2019-2020 The South LaSalle Trading Corporation
 * @license    http://opensource.org/licenses/MIT MIT
 * @author     Bob Bloom
 * @email      bob.bloom@lasallesoftware.ca
 * @link       https://lasallesoftware.ca
 * @link       https://packagist.org/packages/lasallesoftware/ls-contactformfrontend-pkg
 * @link       https://github.com/LaSalleSoftware/ls-contactformfrontend-pkg
 *
 */

namespace Lasallesoftware\Contactformfrontend\Http\Controllers;

// LaSalle Software
use Lasallesoftware\Contactformfrontend\Jobs\CreateNewDatabaseRecord;
use Lasallesoftware\Contactformfrontend\Mail\EmailAdmin;
use Lasallesoftware\Library\Common\Http\Controllers\CommonController;

// Laravel facades
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;


/**
 * This is the controller that handles the contact form's confirmation processing.
 * 
 * @package Lasallesoftware\Contactformfrontend\Http\Controllers\ConfirmationController
 */
class ConfirmationController extends CommonController
{
    /**
     * Receive the input of the contact form, and display the intermediate security view
     *
     * @return void
     */
    public function HandleConfirmation()
    {
        // get the form field user inputs
        $input = Request::input();

        // if the security answer is wrong, go back to the contact form and try again
        if ($input['security_answer'] != $this->getSecurityAnswer($input['first_number'], $input['second_number'])) {
            Session::flash('securityquestioniswrong', __('lasallesoftwarecontactformfrontend::contactformfrontend.security_question_error_message'));
            return back()->withInput();    
        }

        // validation
        $validatedData = Request::validate([
            'first_name' => 'required',
            'surname'    => 'required',
            'email'      => 'required|email',
            'comment'    => 'required|'
        ]);

        // do a quick sanitize
        $sanitizedInput['first_name'] = ucwords($this->quickSanitize($input['first_name']));
        $sanitizedInput['surname']    = ucwords($this->quickSanitize($input['surname']));
        $sanitizedInput['email']      = strtolower($this->quickSanitize($input['email']));
        $sanitizedInput['comment']    = $this->quickSanitize($input['comment']);
        $sanitizedInput['uuid']       = $input['uuid'];

        // if the email exists in the "personbydomains" database field, then get the personbydomains' id
        $sanitizedInput['personbydomain_id'] = $this->getPersonbydomainId($sanitizedInput['email']);

        // get the installed_domain_id
            $sanitizedInput['installed_domain_id'] = $this->getInstalled_domain_id();

        // dispatch the database job
        if (config('lasallesoftware-contactformfrontend.allow_database_insertion')) {
            CreateNewDatabaseRecord::dispatch($sanitizedInput);
        }

        // dispatch the email job
        if (config('lasallesoftware-contactformfrontend.allow_to_send_email')) {
            Mail::to(config('lasallesoftware-contactformfrontend.to_recipients'))
                ->cc(config('lasallesoftware-contactformfrontend.cc_recipients'))
                ->bcc(config('lasallesoftware-contactformfrontend.bcc_recipients'))
                ->queue(new EmailAdmin($sanitizedInput))
            ;
        }

        // display confirmation view
        return view(config('lasallesoftware-contactformfrontend.what_package_are_the_view_files') . 'form.confirmation')
            ->with(['formInput' => $sanitizedInput])
        ;   
    }

    /**
     * Calculate the security answer
     *
     * @param  int  $first_number
     * @param  int  $second_number
     * @return int
     */
    public function getSecurityAnswer($first_number, $second_number)
    {
        return $first_number + $second_number;
    }

    /**
     * Get the personbydomains' ID given an email address. 
     * 
     * Return the value of 0 when no personbydomain_id is found because a null or blank value does not 
     * transmit via post. 
     * See Lasallesoftware\Contactformbackend\Http\Controllers\CreateDatabaseRecordController::HandleCreateDatabaseRecord()
     * 
     * @param  string  $email
     * @return int 
     */
    public function getPersonbydomainId($email)
    {
        $result = DB::table('personbydomains')
            ->where('email', $email)
            ->get()
        ;

        return ($result->isEmpty()) ? 0 : $result[0]->id;
    }
    
    /**
     * Get the installed_domain_id from the installed_domains db table for this front-end app.  
     * 
     * @return mixed 
     */
    public function getInstalled_domain_id()
    {
        return DB::table('installed_domains')
            ->where('title', env('LASALLE_APP_DOMAIN_NAME'))
            ->pluck('id')
            ->first()
        ;
    }
}