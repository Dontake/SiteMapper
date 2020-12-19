<?php

namespace Domtake\SiteMapper;

/**
 * Class Csv
 * @package Domtake\Sitemaper
 */
class Csv extends Creator
{
    const delimiter = ',';
    const enclosure = '"';
    const escape_char = "\\";

    /**
     * Create CSV file in a given directory
     * Write array of pages to this file
     *
     * @param array $page_array     list of pages with params
     * @param string $path          path to directory and name of file
     */
    public function create($page_array, $path)
    {
        $csv_file = fopen($path, 'w');
        $this->writeRows($page_array, $csv_file);

        foreach ($page_array as $item) {
            fputcsv($csv_file, $item, self::delimiter, self::enclosure, self::escape_char);
        }

        fclose($csv_file);
        echo "sitemap.csv created successfully!";
    }

    /**
     * Write rows to the beginning of the file
     *
     * @param array $page_array     list of pages with params
     * @param $csv_file
     */
    protected function writeRows($page_array, $csv_file)
    {
        $csv_rows = null;

        foreach ($page_array as $row) {
            $csv_rows = array_keys($row);
        }

        fputcsv($csv_file, $csv_rows, self::delimiter, self::enclosure, self::escape_char);
    }
}