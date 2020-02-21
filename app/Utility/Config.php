<?php declare(strict_types=1);


namespace App\Utility;

use Exception;
use Throwable;

class Config
{
    /**
     * Get the config value from config directory file
     *
     * @param string $key e.g. 'app.name' or 'database.databaseName'
     * @return mixed
     * @throws Exception
     */
    public static function get(string $key)
    {
        $list = explode('.', $key);
        $collection = self::getConfigCollection($list[0]);
        unset($list[0]);
        $keys = array_values($list);

        if (empty($keys)) {
            return $collection;
        }

        $keys = array_values($list);
        $value = self::getValue($keys, $collection);
        return $value;
    }

    /**
     * Get the value of corresponding key in the collection recursively
     *
     * @param array $keys
     * @param array $collection
     * @return mixed
     * @throws Exception
     */
    public static function getValue(array $keys, array $collection)
    {
        if(!isset($collection[$keys[0]])){
            throw new Exception(sprintf('Specified key %s was not found', $keys[0]));
        }
        $remainingCollection = $collection[$keys[0]];
        if (!is_array($remainingCollection)) {
            return $remainingCollection;
        }
        unset($keys[0]);
        $remainingKeys = array_values($keys);
        return self::getValue($remainingKeys, $remainingCollection);
    }

    /**
     * Get the config array from the file
     *
     * @param string $filename
     * @return array
     * @throws Exception
     */
    private static function getConfigCollection(string $filename): array
    {
        $collection = [];
        try {
            $path = realpath(sprintf(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . '%s.php', $filename));
            if (file_exists($path)) {
                $collection = require $path;
            }
        } catch (Throwable $exception) {
            throw new Exception(sprintf('Specified file %s was not found', $filename));
        }
        return $collection;
    }
}