<?php

namespace SitemapGenerator\Formatters;

class JsonFormatter extends AbstractFormatter
{
  public function format(): string
  {
    return json_encode($this->pages, JSON_PRETTY_PRINT);
  }
}