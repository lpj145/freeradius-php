<?php
/**
 * Date: 12/10/2019
 * This is under MIT license
 * Created to easily work on freeradius when you job at databases.
 * Supported databases: mysql, postrgres.
 * contact at marcos.adantas@hotmail.com
 * licensed under MIT
 */


namespace Freeradius;


class Validate
{
    /**
     * @param $length
     * @param $value
     * @return bool
     */
    public function minLength($length, $value): bool
    {
        return strlen($value) === $length;
    }

    /**
     * @param string $macAddress
     * @return bool
     */
    public function filterByMac(string $macAddress): bool
    {
        return (bool)filter_var($macAddress, FILTER_VALIDATE_MAC);
    }

    /**
     * @param string $ipAddress
     * @return bool
     */
    public function filterByIp(string $ipAddress): bool
    {
        return (bool)filter_var($ipAddress, FILTER_VALIDATE_MAC);
    }
}