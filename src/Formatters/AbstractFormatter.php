<?php

namespace SitemapGenerator\Formatters;

abstract class AbstractFormatter implements FormatterInterface
{
  protected array $pages;

  public function __construct(array $pages)
  {
    $this->pages = $pages;
  }

  abstract public function format(): string;
}
