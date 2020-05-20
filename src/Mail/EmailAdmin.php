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

namespace Lasallesoftware\Contactformfrontend\Mail;

// Laravel Framework
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Send the contact form email to the admins (I assume these are the site admins!)
 *
 * @return void
 */
class EmailAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The contact form's input data.
     * 
     * @var array
     */
    protected $formData; 

    /**
     * Create a new message instance.
     *
     * @param  array  $formInput     The sanitized contact form's data inputted by the user.
     * @return void
     */
    public function __construct($formInput)
    {
        $this->formData = $formInput;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('lasallesoftware-contactformfrontend.subject'))
                    ->from(config('lasallesoftware-contactformfrontend.from_email_address'), config('lasallesoftware-contactformfrontend.from_name'))
                    ->replyTo($this->formData['email'], $this->formData['first_name'] . ' ' . $this->formData['surname'])
                    ->view('lasallesoftwarecontactformfrontend::emails.sendtoadmin')->with(['formData' => $this->formData])
        ;
    }
}