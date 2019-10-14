<?php
/**
 * Date: 11/10/2019
 * Time: 13:43
 * This is under MIT license
 * Created to easily work on freeradius when you job at databases.
 * Supported databases: mysql, postrgres.
 * contact at marcos.adantas@hotmail.com
 * licensed under MIT
 */

namespace Freeradiusphp;


interface RadiusUserInterface
{
    /**
     * This add a Service-Type and Framed-Protocol attributes
     * @return RadiusUserInterface
     */
    public function setPPP(): RadiusUserInterface;

    public function setLogin(string $loginName): RadiusUserInterface;

    public function setPassword(string $password): RadiusUserInterface;

    public function setMacAddress(string $mac): RadiusUserInterface;

    public function setIpAddress(string $ip): RadiusUserInterface;

    public function setLockedToAp(int $idAp): RadiusUserInterface;

    /**
     * @param int $megabytes
     * @return RadiusUserInterface
     */
    public function setDownloadSpeed(int $megabytes): RadiusUserInterface;

    /**
     * @param int $megabytes
     * @return RadiusUserInterface
     */
    public function setUploadSpeed(int $megabytes): RadiusUserInterface;

    /**
     * @param string $attributeName
     * @param $value
     * @return RadiusUserInterface
     */
    public function setCustomAttribute(string $attributeName, $value): RadiusUserInterface;

    public function getLogin(): string;

    public function getPassword(): string;

    public function getMacAddress(): string;

    public function getLockedAp(): string;

    public function getIpAddress(): string;

    public function getDownloadSpeed(): int;

    public function getUploadSpeed(): int;

    public function getCustomAttributes(): array;

    public function isPPP(): bool;

    public function hasLockedToAp(): bool;

    public function hasCustomAttributes(): bool;

    /**
     * Is a errors occur's when db drive tried validation and add record to database.
     */

    /**
     * @param array $errors
     * @return RadiusUser
     */
    public function setErrors(array $errors): RadiusUser;

    public function hasErrors(): bool;

    public function getErrors(): array;
}
