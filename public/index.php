<?php
/**
 * Example of using the library
 */

require __DIR__. '/../vendor/autoload.php';

use Domtake\SiteMapper\Mapper;

$page_array = [
    [
        'loc' => 'https://site.ru/',
        'lastmod' => '2020-12-17',
        'priority' => '1',
        'changefreq' => 'hourly',
    ],
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-17',
        'priority' => '0,5',
        'changefreq' => 'daily',
    ],
    [
        'loc' => 'https://site.ru/about',
        'lastmod' => '2020-12-17',
        'priority' => '0.1',
        'changefreq' => 'weekly',
    ],
    [
        'loc' => 'https://site.ru/products',
        'lastmod' => '2020-12-17',
        'priority' => '0.1',
        'changefreq' => 'weekly',
    ]
];

$type = 'xml';
$path = __DIR__. '\test\sitemap.'.$type;

Mapper::siteMapper($page_array, $path, $type);
