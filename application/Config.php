<?php
namespace Docusign;

class Config
{
    private static $EnvironmentValuesMap = [
        /** Environment Specific Configuration. Removed for Github code sample due to sensitive details **/
    ];

    public static function GetValue(string $key): array
    {
        if(!array_key_exists(APPLICATION_ENV, self::$EnvironmentValuesMap)){
            throw new \Exception("Invalid APPLICATION_ENV");
        }
        if(!array_key_exists($key, self::$EnvironmentValuesMap[APPLICATION_ENV])){
            throw new \Exception("No $key entry for environment " . APPLICATION_ENV . " has been set in the config.");
        }
        return self::$EnvironmentValuesMap[APPLICATION_ENV][$key];
    }
}