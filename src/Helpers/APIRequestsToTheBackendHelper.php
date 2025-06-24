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
 * @copyright  (c) 2019-2025The South LaSalle Trading Corporation
 * @license    http://opensource.org/licenses/MIT
 * @author     Bob Bloom
 * @email      bob.bloom@lasallesoftware.ca
 * @link       https://lasallesoftware.ca
 * @link       https://packagist.org/packages/lasallesoftware/ls-contactformfrontend-pkg
 * @link       https://github.com/LaSalleSoftware/ls-contactformfrontend-pkg
 *
 */

namespace Lasallesoftware\Contactformfrontend\Helpers;

// Laravel
use Illuminate\Support\Arr;

trait APIRequestsToTheBackendHelper
{
    /**
     * Map blog front-end controller and job classes to their admin back-end endpoints.
     * 
     * I thought it would be handy to associate controller and job classes directly to back-end
     * endpoints in one place like this so I can reference this list. As well, having a real
     * array means that as I have to keep this list current when I do future development.
     *
     * @return array
     */
    public function mapFrontendClassesToEndpoints()
    {
        return [
            'CreateNewDatabaseRecord' => '/api/v1/contactform/createdatabaserecord',
        ];
    }

    /**
     * Get the API (back-end) endpoint path for a specific frontend class.
     *
     * @param  string  $frontendClass       Front-end class seeking an enpoint
     * @return string
     */
    public function getEndpointPath($frontendClass)
    {
        $apiEndpointList = $this->mapFrontendClassesToEndpoints();
        
        if (isset($apiEndpointList[$frontendClass])) {
            return $apiEndpointList[$frontendClass];
        }
        
        return NULL;        
    }
}


