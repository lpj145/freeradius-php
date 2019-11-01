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


use Freeradiusphp\Driver\CakeOrm;
use Freeradiusphp\Driver\Debug;
use Freeradiusphp\Validate;

class RadiusDatabase
{
    /**
     * @var null|object|string
     */
    private $databaseDriver;

    private $config = [
        'model' => [

        ]
    ];

    public function __construct($databaseDriver = null, array $options = [])
    {
        $this->defineDatabaseDriver($databaseDriver);

        $this->config = array_merge($this->config, $options);
    }

    public function add(RadiusUserInterface $radiusUser): bool
    {
        $validate = RadiusUserValidation::factory();
        if (!$radiusUser->isValid() && !$validate->validateUser($radiusUser)) {
            return false;
        }



        return true;
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
     * @throws \ErrorException
     */
    protected function validateUserAttributes(RadiusUserInterface $radiusUser): bool
    {

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

        $driverName = get_class($databaseDriver);

        switch ($driverName) {
            case 'Cake\\Database\\Connection':
                $databaseDriver = new CakeOrm($databaseDriver);
                break;
            default:
                throw new \ErrorException('Driver cannot be supported, try a pr');
                break;
        }

        $this->databaseDriver = $databaseDriver;
    }
}
