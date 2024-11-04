<?php

namespace SitemapGenerator\Enums;

enum SitemapGeneratorFormat: string
{
  case XML = 'xml';
  case CSV = 'csv';
  case JSON = 'json';
}
