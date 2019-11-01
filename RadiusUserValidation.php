<?php
/**
 * Date: 16/10/2019
 * This is under MIT license
 * Created to easily work on freeradius when you job at databases.
 * Supported databases: mysql, postrgres.
 * contact at marcos.adantas@hotmail.com
 * licensed under MIT
 */


namespace Freeradiusphp;


class RadiusUserValidation
{
    /**
     * @var $this
     */
    private static $instance;

    private $config = [
        'Login' => [
            'minLength' => [
                'arg' => 5,
                'message' => 'Radius login need be a string sized great than %d'
            ],
            'maxLength' => [
                'arg' => 8,
                'message' => 'Radius login need be a string sized less than %d'
            ]
        ],
        'Password' => [
            'minLength' => [
                'arg' => 5,
                'message' => 'Radius password need be a string or length great than %d'
            ]
        ],
        'MacAddress' => [
            'filterByMac' => [
                'message' => 'Radius mac: %s not have valid value.',
                'withValue' => true
            ]
        ],
        'Ipv4Address' => [
            'filterByIpv4' => [
                'message' => 'Ip address: %s is not valid ivp4',
                'withValue' => true,
                'optional' => true
            ]
        ],
        'Ipv6Address' => [
            'filterByIpv6' => [
                'message' => 'Ip address: %s is not a valid ipv6',
                'withValue' => true,
                'optional' => true
            ]
        ]
    ];

    /**
     * Singletron pattern
     * @param array $config
     * @return RadiusUserValidation
     */
    public static function factory(array $config = [])
    {
        if (is_null(static::$instance)) {
            static::$instance = new static($config);
        }
        return static::$instance;
    }

    public function __construct(array $config = [])
    {
        if ($config) {
            $this->config = array_merge_recursive($this->config, $config);
        }
    }

    /**
     * @param RadiusUserInterface $radiusUser
     * @return bool
     * @throws \ErrorException
     */
    public function validateUser(RadiusUserInterface $radiusUser): bool
    {
        $this->eachAttributeValidate($radiusUser);

        if (!$radiusUser->hasErrors()) {
            $radiusUser->setValid();
        }

        return $radiusUser->isValid();
    }

    /**
     * @param $length
     * @param $value
     * @return bool
     */
    public function maxLength($length, $value): bool
    {
        return strlen($value) <= $length;
    }

    /**
     * @param $length
     * @param $value
     * @return bool
     */
    public function minLength($length, $value): bool
    {
        return strlen($value) >= $length;
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
    public function filterByIpv4(string $ipAddress): bool
    {
        return (bool)filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    public function filterByIpv6(string $ipAddress): bool
    {
        return (bool)filter_var($ipAddress, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6);
    }

    /**
     * @param RadiusUserInterface $radiusUser
     * @return bool
     * @throws \ErrorException
     */
    protected function eachAttributeValidate(RadiusUserInterface $radiusUser)
    {
        $attributes = $this->config;
        $errors = [];

        //Loop all validations config
        foreach ($attributes as $attributeName => $validations) {
            $getterFunctionName = 'get'.$attributeName;

            if (!method_exists($radiusUser, $getterFunctionName)) {
                continue;
            }

            $attributeValue = $radiusUser->{$getterFunctionName}();
            //Execute all validations each by each attributeName
            $resultValidation = $this->eachValidationsFromAttribute($validations, $attributeValue);
            if (true === $resultValidation) {
                continue;
            }

            $errors[$attributeName] = $resultValidation;
        }

        $radiusUser->setErrors($errors);
        return (bool)$errors;
    }

    /**
     * Execute all validations by attributes
     * @param array $validationsFunctions
     * @param $value
     * @return bool|string
     * @throws \ErrorException
     */
    protected function eachValidationsFromAttribute(array $validationsFunctions, $value)
    {
        foreach ($validationsFunctions as $validationName => $validationsConfig) {

            $isOptional = $validationsConfig['optional'] ?? false;

            if ($isOptional && empty($value)) {
                continue;
            }

            if (
                !$this->executeValidation($validationName, $value, $validationsConfig['arg'] ?? null)
            ) {

                if ($validationsConfig['withValue'] ?? false) {
                    $validationsConfig['arg'] = $value;
                }

                return sprintf($validationsConfig['message'], $validationsConfig['arg'] ?? '');
            }
        }

        return true;
    }

    /**
     * @param $validationName
     * @param $value
     * @param null $arg
     * @return mixed
     * @throws \ErrorException
     */
    protected function executeValidation($validationName, $value, $arg = null)
    {
        if (!method_exists($this, $validationName)) {
            throw new \ErrorException('Method '.$validationName.' not exist on '.get_class($this));
        }

        if (is_null($arg)) {
            return $this->{$validationName}($value);
        }

        return $this->{$validationName}($arg, $value);
    }
}