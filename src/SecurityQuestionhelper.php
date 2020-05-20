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
 * @license    http://opensource.org/licenses/MIT
 * @author     Bob Bloom
 * @email      bob.bloom@lasallesoftware.ca
 * @link       https://lasallesoftware.ca
 * @link       https://packagist.org/packages/lasallesoftware/ls-contactformfrontend-pkg
 * @link       https://github.com/LaSalleSoftware/ls-contactformfrontend-pkg
 *
 */

namespace Lasallesoftware\Contactformfrontend;


/**
 * Helper for the security question so controllers using the partial contact form
 * can process the security question.
 * 
 * @package Lasallesoftware\Contactformfrontend\SecurityQuestionhelper.php
 */
class SecurityQuestionhelper
{
    /**
     * Get a random number from 1 to 9 inclusive
     *
     * @return int
     */
    public function getRandomNumber(): int
    {
        return random_int(1, 9);
    }

    /**
     * Calculate the answer to the security question
     *
     * @param int $first_number
     * @param int $second_number
     * @return int
     */
    public function calculateTheSecurityAnswer($first_number, $second_number) : int
    {
        return $first_number + $second_number;
    }
}
