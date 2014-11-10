<?php

namespace Keradus\Traits;

/**
 * Property trait.
 *
 * @warning All changes need to be done in StaticPropertyTrait as well.
 */
trait PropertyTrait
{
    /**
     * Data container.
     */
    protected $container = [];

    /**
     * Get elements.
     *
     * @param list|string[]|string $... elements to get - single name, list or array
     *
     * @return mixed[]|mixed element or array of elements
     */
    public function get()
    {
        $argsCount = func_num_args();

        if (!$argsCount) {
            throw new \BadMethodCallException("Parameter missing");
        }

        $names = (($argsCount > 1) ? func_get_args() : func_get_arg(0));

        if (!is_array($names)) {
            return $this->getOne($names);
        }

        $return = [];
        foreach ($names as $name) {
            $return[$name] = $this->getOne($name);
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
    public function getOne($_name, $_value = null)
    {
        if (!$this->hasOne($_name)) {
            return $_value;
        }

        return $this->container[$_name];
    }

    /**
     * Check if element exists
     *
     * @param string $_name element name
     *
     * @return bool
     */
    public function hasOne($_name)
    {
        return array_key_exists($_name, $this->container);
    }

    /**
     * Remove elements.
     *
     * @param list|string[]|string $... elements to remove - single name, list or array
     */
    public function remove()
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
            $this->removeOne($name);
        }
    }

    /**
     * Remove all elements.
     */
    public function removeAll()
    {
        $this->container = [];
    }

    /**
     * Remove single element.
     *
     * @param string $_name element name
     */
    public function removeOne($_name)
    {
        unset($this->container[$_name]);
    }

    /**
     * Set elements.
     *
     * @param string|array $a element name, element names or elements map
     * @param mixed|array  $b elements value, element values or ignore if $a is elements map
     */
    public function set()
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
            $this->setOne($key, $val);
        }
    }

    /**
     * Set one element.
     *
     * @param string $_name  name
     * @param mixed  $_value value
     */
    public function setOne($_name, $_value)
    {
        $this->container[$_name] = $_value;
    }

    /**
     * Get all elements as array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->get(array_keys($this->container));
    }
}
