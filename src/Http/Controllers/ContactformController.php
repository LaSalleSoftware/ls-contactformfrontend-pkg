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
 * @copyright  (c) 2019-2021 The South LaSalle Trading Corporation
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
use Lasallesoftware\Contactformfrontend\SecurityQuestionhelper;
use Lasallesoftware\Libraryfrontend\Common\Http\Controllers\CommonController;

/**
 * This is the controller that displays the contact form, when the contact form is a separate view with its own route.
 * 
 * @package Lasallesoftware\Contactformfrontend\Http\Controllers\ContactformController
 */
class ContactformController extends CommonController
{
    /**
     * Receive the input of the contact form, and display the intermediate security view
     *
     * @return void
     */
    public function HandleContactForm(SecurityQuestionhelper $securityQuestionhelper)
    {
        // prepare security question
        $question['first_number']  = random_int(1, 9);
        $question['second_number'] = random_int(1, 9);

        // display the contact form
        return view(config('lasallesoftware-contactformfrontend.what_package_are_the_view_files') . 'form.contactform', [
            'question' => $question,
        ]);
    }    
}