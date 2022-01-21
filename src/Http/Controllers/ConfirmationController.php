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
 * @copyright  (c) 2019-2022 The South LaSalle Trading Corporation
 * @license    http://opensource.org/licenses/MIT
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
use Lasallesoftware\Libraryfrontend\Common\Http\Controllers\CommonController;

// Laravel Framework
use Illuminate\Support\Str;

// Laravel facades
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
        $sanitizedInput['first_name'] = ucwords(trim(strip_tags($input['first_name'])));
        $sanitizedInput['surname']    = ucwords(trim(strip_tags($input['surname'])));
        $sanitizedInput['email']      = strtolower(trim(strip_tags($input['email'])));
        $sanitizedInput['comment']    = trim(strip_tags($input['comment']));


        // send this front end app's name, so the back-end can determine the installed_domain_id to insert into the contact_form db table
        $sanitizedInput['lasalle_app_domain_name'] = env('LASALLE_APP_DOMAIN_NAME');


        // should further processing halt due to inputs failing filtering?
        $rejectProcessingDueToFilters = $this->isRejectedDueToFilters($sanitizedInput);


        // dispatch the database job
        if (config('lasallesoftware-contactformfrontend.allow_database_insertion') && (! $rejectProcessingDueToFilters)) {
            CreateNewDatabaseRecord::dispatch($sanitizedInput);
        }

        // dispatch the email job
        if (config('lasallesoftware-contactformfrontend.allow_to_send_email') && (! $rejectProcessingDueToFilters)) {
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


    public function isRejectedDueToFilters($sanitizedInput)
    {
        if ( $this->isContainsRejectedEmail($sanitizedInput['email']) ) {
            return true;
        }

        if ( $this->isContainsRejectedText($sanitizedInput['comment']) ) {
            return true;
        }

        return false;
    }
    
    /**
     * Reject the email address?
     * 
     * @param  string       $email                The contact form's email address field
     */
    public function isContainsRejectedEmail($email)
    {
        $rejectTLD = ['ru', 'cn'];

        $tld = substr($email, -2);

        return Str::contains( strtolower($tld), $rejectTLD );
    }

    private function rejectedTLD()
    {
        return [
            'cn',
            'ru',
            'su',
            'bid',
            'click',
            'diet',
            'download',            
            'link',
            'party',
            'review',
            'science',
            'stream',
            'xyz',
            'zip',
        ];
    }



    /**
     * Does the contact form's message contain certain words/phrases?
     *
     * @param  string       $text                The contact form's content field
     * @return boolean
     */
    public function isContainsRejectedText($text)
    {
        if ( Str::contains(strtolower($text), config('lasallesoftware-contactformfrontend.words_and_phrases_that_cause_contact_form_processing_to_stop')) ) {
            return true;
        }

        if ( Str::contains(strtolower($text), $this->rejectedWords()) ) {
            return true;
        }

        foreach ($this->rejectedSubstrings() as $rejectedSubstring) {
            if (str_contains($text, $rejectedSubstring)) {
                return true;
            }
        }        

        return false;
    }

    private function rejectedWords()
    {
        // must be lower case

        return [
            'agency',
            'babylon',
            'belarus',
            'bible',
            'bitcoin',
            'cyclist',
            'distributors',
            'domain',
            'einkommen',
            'erectile',
            'erection',
            'fake id',
            'fakeid',
            'facebook',
            'hack',
            'investment',
            'investing',
            'joint ventures',
            'joint venture',
            'landing page',
            'luck',
            'lucky',
            'medical product',
            'naked',
            'neckbx',
            'nude',
            'passive',
            'passives',
            'project financing',
            'promote',
            'registration',
            'reputable',       
            'seo',
            'settlement',
            'urgent attention',
            'vidnami',
            'vidyourbiz',
            'winning notification',
            'viagra'
        ];
    }

    private function rejectedSubstrings()
    {
        return [
            'fuck',
        ];
    }
}