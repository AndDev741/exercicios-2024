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
    
    foreach($papers as $paper){
       //Getting the data of title, type and id
       $title = $xPath->query($titleClass, $paper)->item($i)->nodeValue;
       $type = $xPath->query($typeClass, $paper)->item($i)->nodeValue;
       $id = intval($xPath->query($idClass, $paper)->item($i)->nodeValue);
      
       //Getting the authors and his institutes
       $authorsNodes = $xPath->query($authorClass, $paper);
       $allAuthors = [];
       foreach($authorsNodes as $authorNode){//div
         $authors = [];
         foreach($authorNode->childNodes as $item){//span
           if($item->nodeName === 'span'){
             $author = $item->nodeValue;
             $institute = $item->getAttribute('title');
             $authors[] = new Person($author, $institute);
           }
         }
         $allAuthors[] = $authors;
       }
       //instantiating the object of the paper
       $paperObject = new Paper($id, $title, $type, $allAuthors[$i]);
       $papersList[] = $paperObject;
       $i++;
    }

    return $papersList;
  }

}
