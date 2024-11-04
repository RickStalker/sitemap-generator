<?php

namespace SitemapGenerator\Formatters;

class XmlFormatter extends AbstractFormatter
{
  public function format(): string
  {
    $xml = new \SimpleXMLElement('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

    foreach ($this->pages as $page) {
      $url = $xml->addChild('url');
      $url->addChild('loc', $page['loc']);
      $url->addChild('lastmod', $page['lastmod']);
      $url->addChild('priority', $page['priority']);
      $url->addChild('changefreq', $page['changefreq']);
    }

    return $xml->asXML();
  }
} 
