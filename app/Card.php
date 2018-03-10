<?php
namespace App;

/**
* Card class to handle function that related to card operation
* such as shuffle deck, draw card
*
* @author: Freddy <fkresna@gmail.com>>
* 
*/
class Card{
  private $card;
  private $newCard;

  public static function Instance()
  {
    static $inst = null;
    if ($inst === null) {
      $inst = new Card();
    }
    return $inst;
  }

  /**
  * Create shuffled deck from random numbers 
  *
  * @return array return card that has been shuffledn 
  */
  function shuffleCard(): array {
    $newCard = $this->getNewCard();
    unset($this->card);
    $this->card = [];
    for($i=1;$i<=52;$i++) {
      $number[] = $i;
    }

    $cardEmpty = false;

    $count = 0;
    do {
      $n = rand(1,52);
      if (in_array($n,$number)) {
        $this->card[] = $newCard[$n-1];
        $number[$n-1] = -1;
        $count++;
      } else{
        if ($count == 52) {
          $cardEmpty = true;
        }
      }
    } while($cardEmpty != true);
    return $this->card;
  }

  /**
  * Create a new sorted deck card
  *
  * @return array return new deck set of card
  */
  function getNewCard(): array{
    unset($this->newCard);
    $this->newCard = [];
    $cardName = "";
    for ($i=0;$i<4;$i++) {
      for ($j=1;$j<=13;$j++) {
        if ($i == 0) {
          $cardName = "heart";
        } else if ($i == 1) {
          $cardName = "spade";
        } else if ($i == 2) {
          $cardName = "club";
        } else if ($i == 3) {
          $cardName = "diamond";
        }

        if ($j == 11) {
          $cardName .= " jack";
        } else if($j == 12) {
          $cardName .= " queen";
        } else if($j == 13) {
          $cardName .= " king";
        } else if($j == 1) {
          $cardName .= " ace";
        }else {
          $cardName = $cardName." ".$j;
        }
        $this->newCard[] = $cardName;
      }
    }
    return $this->newCard;
  }

  /**
  * Draw Card function
  *
  * @return string return card that on the top of the deck
  */
  function drawCard(): string{
    $card = array_pop($this->card);
    return $card;
  }

  /**
  *
  * @return int return number of card that still on the deck
  */
  function count(): int{
    return count($this->card);
  }
}
