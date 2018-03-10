<?php
/**
* CardTest class to handle test for Card class
* 
* @author Freddyi <fkresna@gmail.com>
*/
use PHPUnit\Framework\TestCase;
use App\Card;

include __DIR__."/../app/Card.php";

final class CardTest extends TestCase {

  /**
  * Function to test instance of Card
  */
  public function testCard(): void {
    $card = new Card();
    $this->assertInstanceOf(Card::class,$card);
  }

  /**
  * Function to test new deck of card
  */
  public function testNewCard(): void {
    $cardName = array("heart ace","heart 2","heart 3","heart 4","heart 5",
      "heart 6","heart 7","heart 8","heart 9","heart 10",
      "heart jack","heart queen","heart king",
      "spade ace","spade 2","spade 3","spade 4","spade 5",
      "spade 6","spade 7","spade 8","spade 9","spade 10",
      "spade jack","spade queen","spade king",
      "club ace","club 2","club 3","club 4","club 5",
      "club 6","club 7","club 8","club 9","club 10",
      "club jack","club queen","club king",
      "diamond ace","diamond 2","diamond 3","diamond 4","diamond 5",
      "diamond 6","diamond 7","diamond 8","diamond 9","diamond 10",
      "diamond jack","diamond queen","diamond king");
    $card = new Card();
    $newCard = $card->getNewCard();
    for($i=0;$i<52;$i++) {
      if($newCard[$i] != $cardName[$i]) {
        echo $i;
        echo "\n";
        echo $newCard[$i];
        echo "\n";
        echo $cardName[$i];
        $this->assertFalse($newCard[$i] != $cardName[$i]);
      }
    }
  }

 /**
  * Function to test shuffled Card by checking no same card in the deck
  */
  public function testShuffleCard(): void {
    $card = new Card();
    $shuffleCard = $card->shuffleCard();
    for($i=0;$i<51;$i++) {
      for ($j = $i+1;$j<52;$j++) {
        if($shuffleCard[$i] == $shuffleCard[$j]) {
          $this->assertFalse($shuffleCard[$i] == $shuffleCard[$j]);
        }
      }
    }
  }

  /**
  * Function to test drawing a card
  */
  public function testDrawCard(): void {
    $card = new Card();
    $shuffleCard = $card->shuffleCard();
    $card2 = $card->drawCard();
    $this->assertEquals($card2,$shuffleCard[count($shuffleCard)-1]);
  }

  /**
  * Function to text count card in the deck
  */
  public function testCountCard(): void {
    $card = new Card();
    $shuffleCard = $card->shuffleCard();
    $card->drawCard();
    $card->drawCard();
    $this->assertEquals(50,$card->count());
  }
}
?>
