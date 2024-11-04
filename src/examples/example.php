<?php

require 'vendor/autoload.php';

use SitemapGenerator\Enums\SitemapGeneratorFormat;
use SitemapGenerator\SitemapGenerator;

$pages = [
  [
    'loc' => 'https://site1.ru/',
    'lastmod' => '2020-12-14',
    'priority' => '1',
    'changefreq' => 'hourly'
  ],
  [
    'loc' => 'https://site.ru/news',
    'lastmod' => '2020-12-10',
    'priority' => '0.5',
    'changefreq' => 'daily'
  ],
];

try {
  $sitemap = new SitemapGenerator($pages, SitemapGeneratorFormat::XML, '/home/rick/dev/sitemap-generator/src/examples/result/sitemap.xml');
  $sitemap->generateSitemap();
  echo "Sitemap generated successfully!\n";
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
