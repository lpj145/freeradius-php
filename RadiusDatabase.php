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
use Freeradius\Validate;

class RadiusDatabase
{
    /**
     * @var null|object|string
     */
    private $databaseDriver;
    /**
     * @var Validate
     */
    private $validate;

    private $config = [
        'validations' => [
            'Login' => [
                'minLenght' => [
                    'arg' => 5,
                    'message' => 'Radius login need be a string or length great than %d'
                ]
            ],
            'Password' => [
                ['minLength' => [
                    'arg' => 5,
                    'message' => 'Radius password need be a string or length great than %d'
                ]]
            ],
            'MacAddress' => [
                'macAddress' => [
                    'message' => [
                        'Radius password need be a string or length great than %d'
                    ]
                ]
            ],
            'IpAddress' => [
                'ipAddress'
            ]
        ],
        'model' => [

        ]
    ];

    public function __construct($databaseDriver = null, array $options = [])
    {
        $this->defineDatabaseDriver($databaseDriver);
        $this->validate = new Validate();

        $this->config = array_merge($this->config, $options);
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
        $validationsOptions = $this->config['validations'];

        foreach ($validationsOptions as $optionName => $option) {
            $funcName = 'get'.$optionName;


        }
        $this->validate->minLength($this->config['login']['validation'])
    }

    /**
     * @param $databaseDriver
     * @throws \ErrorException
     */
    protected function defineDatabaseDriver($databaseDriver): void {
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
