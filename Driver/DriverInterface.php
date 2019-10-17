<?php
/**
 * Date: 11/10/2019
 * This is under MIT license
 * Created to easily work on freeradius when you job at databases.
 * Supported databases: mysql, postrgres.
 * contact at marcos.adantas@hotmail.com
 * licensed under MIT
 */

namespace Freeradiusphp\Driver;


use Freeradiusphp\RadiusUserInterface;

interface DriverInterface
{
    public function save(RadiusUserInterface $radiusUser): bool;

    public function delete(RadiusUserInterface $radiusUser): bool;

    public function update(RadiusUserInterface $radiusUser): bool;
}