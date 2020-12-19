<?php

namespace Domtake\SiteMapper;

use Exception;

/**
 * Class Mapper
 * @package Domtake\SiteMapper
 */
class Mapper
{
    /**
     * Creates a file in a given directory and specified type
     *
     * @param array $page_array     list of pages with params
     * @param string $path          path to directory and name of file
     * @param string $type          type of creating file
     */
    static function siteMapper($page_array, $path, $type)
    {
        self::makeDir($path);
        $mapper = null;

        switch ($type) {
            case 'xml':
                $mapper = new Xml();
                break;

            case 'json':
                $mapper = new Json();
                break;

            case 'csv':
                $mapper = new Csv();
                break;

            default:
                echo 'invalid type specified!';
        }

        $mapper->create($page_array, $path);
    }

    /**
     * Create a directory in a given path if it does not exist
     *
     * @param string $path          path to directory
     */
    static function makeDir($path)
    {
        $path_info = pathinfo($path);
        $dir = $path_info['dirname'];

        try {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
        } catch (Exception $e) {
            // if directory can't create
            echo "There was a problem with the directory: " . $e->getMessage();
        }
    }
}