<?php

namespace Domtake\SiteMapper;

/**
 * Class Json
 * @package Domtake\Sitemaper
 */
class Json extends Creator
{
    /**
     * Create JSON file in a given directory
     * Write array of pages to this file
     *
     * @param array $page_array     list of pages with params
     * @param string $path          path to directory and name of file
     */
    public function create($page_array, $path)
    {
        $json_file = fopen($path, 'w');

        fwrite($json_file, json_encode($page_array));

        fclose($json_file);
        echo "sitemap.json created successfully!";
    }
}