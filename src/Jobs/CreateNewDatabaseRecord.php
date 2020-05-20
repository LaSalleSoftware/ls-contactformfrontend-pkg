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

namespace Lasallesoftware\Contactformfrontend\Jobs;

// LaSalle Softare
use Lasallesoftware\Contactformfrontend\Helpers\APIRequestsToTheBackendHelper;
use Lasallesoftware\Library\APIRequestsToTheBackend\HttpRequestToAdminBackend;

// Laravel classes
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class CreateNewDatabaseRecord
 *
 * @package Lasallesoftware\Contactformfrontend\Jobs\CreateNewDatabaseRecord
 */
class CreateNewDatabaseRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use APIRequestsToTheBackendHelper, HttpRequestToAdminBackend;


    /**
     * Contact form input data.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $uuid         = $this->data['uuid'];
        $endpointPath = $this->getEndpointPath('CreateNewDatabaseRecord');
        $httpRequest  = 'POST';
        $data         = $this->data;

        $response = $this->sendRequestToLasalleBackend($uuid, $endpointPath, $httpRequest, null, $data);
    }
}