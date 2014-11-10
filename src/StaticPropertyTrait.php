<?php

namespace Keradus\Traits;

/**
 * Property trait in static way.
 *
 * @warning All changes need to be done in PropertyTrait as well.
 */
trait StaticPropertyTrait
{
    /**
     * Data container.
     */
    protected static $container = [];

    /**
     * Get elements.
     *
     * @param list|string[]|string $... elements to get - single name, list or array
     *
     * @return mixed[]|mixed element or array of elements
     */
    public static function get()
    {
        $argsCount = func_num_args();

        if (!$argsCount) {
            throw new \BadMethodCallException("Parameter missing");
        }

        $names = (($argsCount > 1) ? func_get_args() : func_get_arg(0));

        if (!is_array($names)) {
            return static::getOne($names);
        }

        $return = [];
        foreach ($names as $name) {
            $return[$name] = static::getOne($name);
        }

        return $return;
    }

    /**
     * Get single element.
     *
     * @param string $_name  element name
     * @param mixed  $_value default value if element is missing
     *
     * @return mixed element value
     */
    public static function getOne($_name, $_value = null)
    {
        if (!static::hasOne($_name)) {
            return $_value;
        }

        return static::$container[$_name];
    }

    /**
     * Check if element exists
     *
     * @param string $_name element name
     *
     * @return bool
     */
    public static function hasOne($_name)
    {
        return array_key_exists($_name, static::$container);
    }

    /**
     * Remove elements.
     *
     * @param list|string[]|string $... elements to remove - single name, list or array
     */
    public static function remove()
    {
        $argsCount = func_num_args();

        if (!$argsCount) {
            throw new \BadMethodCallException("Parameter missing");
        }

        $names = (($argsCount > 1) ? func_get_args() : func_get_arg(0));

        if (!is_array($names)) {
            $names = [$names];
        }

        foreach ($names as $name) {
            static::removeOne($name);
        }
    }

    /**
     * Remove all elements.
     */
    public static function removeAll()
    {
        static::$container = [];
    }

    /**
     * Remove single element.
     *
     * @param string $_name element name
     */
    public static function removeOne($_name)
    {
        unset(static::$container[$_name]);
    }

    /**
     * Set elements.
     *
     * @param string|array $a element name, element names or elements map
     * @param mixed|array  $b elements value, element values or ignore if $a is elements map
     */
    public static function set()
    {
        $argsCount = func_num_args();

        if (!$argsCount) {
            throw new \BadMethodCallException("Parameter missing");
        }

        if ($argsCount > 2) {
            throw new \BadMethodCallException("Too many arguments");
        }

        $dictionary = [];

        if ($argsCount === 1) {
            $dictionary = func_get_arg(0);

            if (!is_array($dictionary)) {
                throw new \BadMethodCallException("Only one parameter, but it is not array");
            }
        } elseif ($argsCount === 2) {
            $keys = func_get_arg(0);
            $args = func_get_arg(1);

            if (is_array($keys)) {
                if (!is_array($args)) {
                    throw new \BadMethodCallException("The first parameter is array, but the second does not");
                }

                if (count($keys) !== count($args)) {
                    throw new \BadMethodCallException("Passed arrays are of different sizes");
                }

                $dictionary = array_combine($keys, $args);
            } else {
                $dictionary[$keys] = $args;
            }
        }

        foreach ($dictionary as $key => $val) {
            static::setOne($key, $val);
        }
    }

    /**
     * Set one element.
     *
     * @param string $_name  name
     * @param mixed  $_value value
     */
    public static function setOne($_name, $_value)
    {
        static::$container[$_name] = $_value;
    }

    /**
     * Get all elements as array.
     *
     * @return array
     */
    public static function toArray()
    {
        return static::get(array_keys(static::$container));
    }
}
