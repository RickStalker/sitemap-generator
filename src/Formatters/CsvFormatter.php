<?php

namespace SitemapGenerator\Formatters;

class CsvFormatter extends AbstractFormatter
{
  public function format(): string
  {
    $csvLines = ['loc;lastmod;priority;changefreq'];
    foreach ($this->pages as $page) {
      $csvLines[] = implode(';', $page);
    }

    return implode("\n", $csvLines);
  }
}
