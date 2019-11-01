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


class RadiusUser implements RadiusUserInterface
{
    /**
     * @var bool
     */
    private $blockedToPPP = false;

    private $login = '';
    /**
     * @var string
     */
    private $password = '';
    /**
     * @var string
     */
    private $macAddress = '';
    /**
     * @var string
     */
    private $ipAddress = '';
    /**
     * @var string
     */
    private $ipv6 = '';

    /**
     * @var integer
     */
    private $idAccessPoint;

    private $downloadSpeed;

    private $uploadSpeed;

    private $attributes = [];
    /**
     * @var array
     */
    private $errors = [];

    private $valid = false;

    /**
     * @param bool $active
     * @return RadiusUserInterface
     */
    public function setPPP(bool $active = true): RadiusUserInterface
    {
        $this->blockedToPPP = $active;
        return $this;
    }

    /**
     * @param string $loginName
     * @return RadiusUserInterface
     */
    public function setLogin(string $loginName): RadiusUserInterface
    {
        $this->login = $loginName;
        return $this;
    }

    /**
     * @param string $password
     * @return RadiusUserInterface
     */
    public function setPassword(string $password): RadiusUserInterface
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $mac
     * @return RadiusUserInterface
     */
    public function setMacAddress(string $mac): RadiusUserInterface
    {
        $this->macAddress = $mac;
        return $this;
    }

    /**
     * @param string $ip
     * @return RadiusUserInterface
     */
    public function setIpv4Address(string $ip): RadiusUserInterface
    {
        $this->ipAddress = $ip;
        return $this;
    }

    public function setIpv6Address(string $ipv6): RadiusUserInterface
    {
        $this->ipv6 = $ipv6;
        return $this;
    }

    /**
     * @param int $idAp
     * @return RadiusUserInterface
     */
    public function setLockedToAp(int $idAp): RadiusUserInterface
    {
        $this->idAccessPoint = $idAp;
        return $this;
    }

    /**
     * @param int $megabytes
     * @return RadiusUserInterface
     */
    public function setDownloadSpeed(int $megabytes): RadiusUserInterface
    {
        $this->downloadSpeed = $megabytes;
        return $this;
    }

    /**
     * @param int $megabytes
     * @return RadiusUserInterface
     */
    public function setUploadSpeed(int $megabytes): RadiusUserInterface
    {
        $this->uploadSpeed = $megabytes;
        return $this;
    }

    public function setCustomAttribute(string $attributeName, $value): RadiusUserInterface
    {
        $this->attributes[$attributeName] = $value;
        return $this;
    }


    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getMacAddress(): string
    {
        return $this->macAddress;
    }

    /**
     * @return string
     */
    public function getLockedAp(): string
    {
        return $this->idAccessPoint;
    }

    /**
     * @return string
     */
    public function getIpv4Address(): string
    {
        return $this->ipAddress;
    }

    /**
     * @return string
     */
    public function getIpv6Address(): string
    {
        return $this->ipv6;
    }

    /**
     * @return int
     */
    public function getDownloadSpeed(): int
    {
        return $this->downloadSpeed;
    }

    /**
     * @return int
     */
    public function getUploadSpeed(): int
    {
        return $this->uploadSpeed;
    }

    /**
     * @return array
     */
    public function getCustomAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return bool
     */
    public function isPPP(): bool
    {
        return $this->blockedToPPP;
    }

    /**
     * @return bool
     */
    public function hasLockedToAp(): bool
    {
        return is_null($this->idAccessPoint);
    }

    /**
     * @return bool
     */
    public function hasCustomAttributes(): bool
    {
        return count($this->attributes) > 0;
    }

    /**
     * @param array $errors
     * @return RadiusUser
     */
    public function setErrors(array $errors): RadiusUserInterface
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function setValid(): RadiusUserInterface
    {
        $this->valid = true;
        return $this;
    }
}
