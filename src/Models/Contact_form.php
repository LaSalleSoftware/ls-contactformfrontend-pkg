<?php

/**
 * This file is part of the Lasalle Software contact form back-end package
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
 * @link       https://packagist.org/packages/lasallesoftware/lsv2-contactformbackend-pkg
 * @link       https://github.com/LaSalleSoftware/lsv2-contactformbackend-pkg
 *
 */

namespace Lasallesoftware\Contactformbackend\Models;

// LaSalle Software
use Lasallesoftware\Library\Common\Models\CommonModel;

// Third party class
use Carbon\Carbon;


class Contact_form extends CommonModel
{
    ///////////////////////////////////////////////////////////////////
    //////////////          PROPERTIES              ///////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'contact_form';

    /**
     * Which fields may be mass assigned
     * @var array
     */
    protected $fillable = [
        'first_name',
        'surname',
        'email',
        'message',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * LaSalle Software handles the created_at and updated_at fields, so false.
     *
     * @var bool
     */
    public $timestamps = false;


    ///////////////////////////////////////////////////////////////////
    //////////////        RELATIONSHIPS             ///////////////////
    ///////////////////////////////////////////////////////////////////

    /*
     * One to one relationship with personbydomains.
     *
     * Method name must be:
     *    * the model name,
     *    * NOT the table name,
     *    * singular;
     *    * lowercase.
     *
     * @return Eloquent
     */
    public function personbydomain()
    {
        return $this->hasOne('Lasallesoftware\Library\Authentication\Models\Personbydomain');
    }

    /*
     * One to one relationship with uuid.
     *
     * Method name must be:
     *    * the model name,
     *    * NOT the table name,
     *    * singular;
     *    * lowercase.
     *
     * @return Eloquent
     */
    public function uuid()
    {
        return $this->hasOne('Lasallesoftware\Library\UniversallyUniqueIDentifiers\Uuid');
    }


    ///////////////////////////////////////////////////////////////////
    //////////////         CRUD ACTIONS             ///////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Create a new contact_form database table record
     *
     * @param  array $data
     * @return mixed
     */
    public function createNewContactformRecord($data)
    {
        $contactform = new Contact_form;

        $contactform->personbydomains_id = $data['personbydomains_id'] ?? null;
        $contactform->first_name         = $data['first_name'];
        $contactform->surname            = $data['surname'];
        $contactform->email              = $data['email'];
        $contactform->message            = $data['comment'];
        $contactform->uuid               = $data['uuid'] ?? NULL;
        $contactform->created_at         = Carbon::now(null);
        $contactform->created_by         = $data['created_by'] ?? 1;

        if ($contactform->save()) {
            // Return the new ID
            return $contactform->id;
        }
        return false;
    }
}