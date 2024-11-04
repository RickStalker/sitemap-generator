<?php

namespace SitemapGenerator\Formatters;

interface FormatterInterface
{
  public function format(): string;
}
