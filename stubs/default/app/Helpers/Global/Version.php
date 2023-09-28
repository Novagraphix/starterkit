<?php

namespace App\Helpers;

class Version
{
    private static $value;

    public static function set()
    {
        $configPath = config_path('version.json');
        $configData = json_decode(file_get_contents($configPath), true);
        $additional = $configData['additions'];
        unset($configData['additions']);

        $version = implode('.', $configData);
        if ($additional != '') $version = implode('.', $configData) . '-' . $additional;

        static::$value = $version;
    }

    public static function get()
    {
        return static::$value;
    }
}
