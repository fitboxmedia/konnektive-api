<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/7/2016
 * Time: 6:49 AM
 */

namespace Konnektive;


final class Config
{
    protected static $configDir;
    protected static $resolvedConfig = [];

    public static function getInstance()
    {
        if (!isset($dataDir)) {
            static::$configDir = dirname(__FILE__) . '/Config/';
        }

        static $inst = null;
        if ($inst === null) {
            $inst = new Config();
        }

        return $inst;
    }

    private function __construct()
    {
    }

    protected static function get($key)
    {
        if(empty($key) || !is_scalar($key)){
            throw new \InvalidArgumentException("Invalid key provided");
        }

        $config = explode('.', $key);
        if (is_array($config) && isset($config[0]) && !isset(static::$resolvedConfig[$config[0]])) {
            static::loadConfig($config[0]);
        } else if (!empty($config) && is_scalar($config)) {
            static::loadConfig($config);
        }

        array_shift($config);
        if (is_array($config) && !empty($config) && isset(static::$resolvedConfig[$config[0]])) {
            $nodes = &static::$resolvedConfig;
            foreach ($config as $nodeKey) {
                if (!isset($nodes[$nodeKey])) {
                    return "";
                }

                $nodes = &$nodes[$nodeKey];
            }
        } else {
            return isset(static::$resolvedConfig[$key]) ? static::$resolvedConfig[$key] : null;
        }
    }

    private static function loadConfig($filename)
    {
        $filePath = static::$configDir . $filename . ".php";

        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("Configuration file does not exist");
        }

        static::$resolvedConfig[$filename] = include($filePath);
    }

    public static function __callStatic($method, $arguments)
    {
        $instance = static::getInstance();

        if (!$instance) {
            throw new \RuntimeException('An instance could not be resolved');
        }

        return forward_static_call_array(array(static::class, $method), $arguments);
    }

}