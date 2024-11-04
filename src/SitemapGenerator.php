<?php 

namespace SitemapGenerator;

use SitemapGenerator\Enums\SitemapGeneratorFormat;
use SitemapGenerator\Formatters\XmlFormatter;
use SitemapGenerator\Formatters\CsvFormatter;
use SitemapGenerator\Formatters\JsonFormatter;
use SitemapGenerator\Exceptions\UnknownFormat;
use SitemapGenerator\Exceptions\InvalidDataException;
use SitemapGenerator\Exceptions\FileWriteException;
use SitemapGenerator\Exceptions\DirectoryCreationException;
use SitemapGenerator\Formatters\FormatterInterface;

class SitemapGenerator
{
  private array $pages;
  private SitemapGeneratorFormat $format;
  private string $outputFilePath;

  public function __construct(array $pages, SitemapGeneratorFormat $format, string $outputFilePath)
  {
    $this->validate($pages, $outputFilePath);
    $this->initOutputDir($outputFilePath);
    $this->format = $format;
    $this->pages = $pages;
    $this->outputFilePath = $outputFilePath;
  }

  public function generateSitemap(): void
  {
    $content = $this->getFormatter()->format();
    
    $isFailed = file_put_contents($this->outputFilePath, $content) === false;

    if ($isFailed) {
      throw new FileWriteException('Failed to write to file.');
    }
  }

  private function validate(array $pages, string $outputFilePath): void
  {
    $this->validatePages($pages);
    $this->validateOutputFilePath($outputFilePath);
  }

  private function validatePages(array $pages):void
  {
    foreach ($pages as $page) {
      if (!isset($page['loc'], $page['lastmod'], $page['priority'], $page['changefreq'])) {
        throw new InvalidDataException('Invalid page data structure.');
      }
    }
  }

  private function validateOutputFilePath(string $outputFilePath): void
  {
    if (!trim($outputFilePath)) {
      throw new InvalidDataException('Output file name cannot be empty.');
    }
  }

  private function initOutputDir(string $outputFilePath): void
  {
    if (!is_dir(dirname($outputFilePath)) && !mkdir(dirname($outputFilePath), 0755, true)) {
      throw new DirectoryCreationException('Failed to create directory.');
    }
  }

  private function getFormatter(): FormatterInterface
  {
    switch ($this->format) {
      case SitemapGeneratorFormat::XML:
        return new XmlFormatter($this->pages);
      case SitemapGeneratorFormat::CSV:
        return new CsvFormatter($this->pages);
      case SitemapGeneratorFormat::JSON:
        return new JsonFormatter($this->pages);
      default:
        throw new UnknownFormat('Unknown format: ' . $this->format);
    }
  }
}

