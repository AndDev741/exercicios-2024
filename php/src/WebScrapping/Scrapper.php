<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    //Class of the elements
    $papersClass = "//a[@class='paper-card p-lg bd-gradient-left']";
    $titleClass = "//h4[@class='my-xs paper-title']";
    $authorClass = "//div[@class='authors']";
    $typeClass = "//div[@class='tags mr-sm']";
    $idClass = "//div[@class='volume-info']";

    $papersList = [];

    $xPath = new \DOMXPath($dom);
    $papers = $xPath->query($papersClass);
    $i = 0;

    return $papersList;
  }

}
