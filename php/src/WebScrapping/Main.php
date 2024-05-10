<?php

namespace Chuva\Php\WebScrapping;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Cell\NumericCell;
use OpenSpout\Common\Entity\Cell\StringCell;
/**
 * Runner for the Webscrapping exercice.
 */
class Main {

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');

    $data = (new Scrapper())->scrap($dom);
    // Write your logic to save the output file bellow.
    //Assembling the spreadsheet format
    $writer = new Writer();

    $writer->openToFile(__DIR__ . '/../../assets/teste.xlsx');

    $headerRow = new Row([
      new StringCell('ID', null),
      new StringCell('Title', null),
      new StringCell('Type', null)
    ]);
  for ($i = 1; $i <= 9; $i++) {
      $headerRow->addCell(new StringCell("Author $i", null));
      $headerRow->addCell(new StringCell("Author $i Institution", null));
  }
  $writer->addRow($headerRow);
  }

}
