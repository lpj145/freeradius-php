<?php
/**
 * Created by PhpStorm.
 * User: Marquinho
 * Date: 11/10/2019
 * Time: 15:47
 */

namespace Freeradius\Driver;


use Cake\Database\Connection;
use Freeradiusphp\RadiusUserInterface;

class CakeOrm implements DriverInterface
{
    /**
     * @var Connection
     */
    private $database;

    public function __construct(Connection $database)
    {
        $this->database = $database;
    }

    public function save(RadiusUserInterface $radiusUser): bool
    {
        // TODO: Implement save() method.
    }

    public function delete(RadiusUserInterface $radiusUser): bool
    {
        // TODO: Implement delete() method.
    }

    public function update(RadiusUserInterface $radiusUser): bool
    {
        // TODO: Implement update() method.
    }

}
