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
 * @link       https://packagist.org/packages/lasallesoftware/lsv2-contactformfrontend-pkg
 * @link       https://github.com/LaSalleSoftware/lsv2-contactformfrontend-pkg
 *
 */

namespace Lasallesoftware\Contactformfrontend\Jobs;

// LaSalle Softare
use Lasallesoftware\Library\Common\Http\Controllers\CommonControllerForClients;

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
    public function handle(CommonControllerForClients $commoncontrollerforclients)
    {

        /*echo "the uuid = " . $this->data['uuid'];
        echo "<pre>";
        print_r($this->data);
        dd();*/

        $path = 'contactformfrontendcreatedatabaserecord';

        echo "path = " . $path;
        

        $response = $commoncontrollerforclients->sendRequestToLasalleBackend($this->data['uuid'], $path); 

        $body           = json_decode($response->getBody());

        echo "<pre>";
        var_dump($body);
        dd();
    }
}