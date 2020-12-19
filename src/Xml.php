<?php

namespace Domtake\SiteMapper;

use DOMDocument;
use Exception;

/**
 * Class Xml
 * @package Domtake\Sitemaper
 */
class Xml extends Creator
{
    protected $xmlDoc;
    protected $root;
    protected $version = '1.0';

    public function __construct()
    {
        $this->xmlDoc = new domDocument($this->version, "utf-8");

        $this->root = $this->xmlDoc->createElement("urlset");
        $this->xmlDoc->appendChild($this->root);
    }

    /**
     * Create XML document in a given directory
     * Write array of pages to this doc
     *
     * @param array $page_array     list of pages with params
     * @param string $path          path to directory and name of file
     */
    public function create($page_array, $path)
    {
        $this->xmlDoc->formatOutput = true;

        $this->addAttributes();

        foreach ($page_array as $key => $value) {
            $this->createNode($value);
        }

        try {
            if (file_exists($path)) {
                unlink($path);
            }
            $this->xmlDoc->save($path);
            echo "sitemap.xml created successfully!";

        } catch (Exception $e) {
            echo 'Сan\'t create here!', $e->getMessage(), "\n";
        }

    }

    /**
     * Add attributes to root element of xml document
     */
    protected function addAttributes()
    {
        $attributes = [
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/' . $this->version,
            'xsi:schemaLocation' => 'http://www.sitemaps.org/schemas/sitemap/' . $this->version
                . ' http://www.sitemaps.org/schemas/sitemap/' . $this->version . '/sitemap.xsd'
        ];

        foreach ($attributes as $key => $value) {
            $this->root->setAttribute($key, $value);
        }
    }

    /**
     * Create node of xml document
     *
     * @param array $page           array of values $page_array
     */
    protected function createNode($page)
    {
        $url = $this->xmlDoc->createElement("url");
        $this->root->appendChild($url);

        foreach ($page as $key => $value) {
            $element = $this->xmlDoc->createElement($key, $value);
            $url->appendChild($element);
        }
    }
}