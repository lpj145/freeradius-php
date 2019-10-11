<?php
/**
 * Date: 11/10/2019
 * This is under MIT license
 * Created to easily work on freeradius when you job at databases.
 * Supported databases: mysql, postrgres.
 * contact at marcos.adantas@hotmail.com
 * licensed under MIT
 */

namespace Freeradiusphp;


use Freeradius\Driver\CakeOrm;
use Freeradius\Driver\Debug;

class RadiusDatabase
{
    /**
     * @var null|object|string
     */
    private $databaseDriver;

    private $config = [
        'model' => [
            'login' => [
                'validations' => [
                    'minLength' => 5,
                    'message' => 'Radius login need be a string or length great than %d'
                ]
            ],
            'password' => [
                'validations' => [
                    'minLength' => 5,
                    'message' => 'Radius password need be a string or length great than %d'
                ]
            ],
            'mac' => [
                'filters' => [
                    'macAddress',
                ]
            ]
        ]
    ];

    public function __construct($databaseDriver = null, array $options = [])
    {
        $this->defineDatabaseDriver($databaseDriver);
    }

    public function add(RadiusUserInterface $radiusUser): bool
    {
        $this->validateUserAttributes($radiusUser);
    }

    public function remove(RadiusUserInterface $radiusUser): bool
    {

    }

    public function block(RadiusUserInterface $radiusUser): bool
    {

    }

    /**
     * Validate: mac, ip, login length, password length
     * @param RadiusUserInterface $radiusUser
     * @return bool
     */
    protected function validateUserAttributes(RadiusUserInterface $radiusUser): bool
    {

    }

    /**
     * @param $databaseDriver
     * @throws \ErrorException
     */
    protected function defineDatabaseDriver($databaseDriver) {
        if (is_string($databaseDriver) || is_null($databaseDriver)) {
            $this->databaseDriver = new Debug();
            return;
        }

        switch ($databaseDriver) {
            case '\\Cake\\Database\\Connection':
                $databaseDriver = new CakeOrm($databaseDriver);
                break;
            default:
                throw new \ErrorException('Driver cannot be supported, try a pr');
                break;
        }

        $this->databaseDriver = $databaseDriver;
    }
}
