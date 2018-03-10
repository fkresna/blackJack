<?php
namespace App;
include __DIR__."/Card.php";

class BlackJack
{
  private $card;

  public function __construct($newGame) {
    
    if ($newGame == TRUE) {
      $this->card = Card::Instance();
      $this->card->shuffleCard();  
      $_SESSION['card'] = serialize($this->card);
    } else {
      $this->card = unserialize($_SESSION['card']);
    }
  }

  public function deal() {
    //draw card 2 times
    $pCard[] = $this->card->drawCard(); 
    $dCard[] = $this->card->drawCard();
    $pCard[] = $this->card->drawCard();
    $dCard[] = $this->card->drawCard();
    
    $_SESSION['pScore'] = $this->countScore($pCard);
    $_SESSION['dScore'] = $this->countScore($dCard);

    $_SESSION['pCard'] = $pCard;
    $_SESSION['dCard'] = $dCard;
    $_SESSION['isPlaying'] = TRUE;
    $_SESSION['pStatus'] = "deal";
    $_SESSION['dStatus'] = "deal";
    $_SESSION['winner'] = 0;
    if(!$this->checkScore()) {
      $_SESSION['isPlaying'] = FALSE;
    }
  }

  public function hit(): void {
    $_SESSION['pStatus'] = "hit";
    $pCard = $_SESSION['pCard'];
    $pCard[] = $this->card->drawCard();
    $_SESSION['pCard'] = $pCard;
    $_SESSION['pScore'] = $this->countScore($pCard);

    //Dealer stand if the score >= 17
    if ($_SESSION['dScore']>=17) {
      $_SESSION['dStatus'] = "stand";
    //Dealer hit if the score < 17
    } else {
      $dCard = $_SESSION['dCard'];
      $dCard[] = $this->card->drawCard();
      $_SESSION['dCard'] = $dCard;
      $_SESSION['dScore'] = $this->countScore($dCard);
      $_SESSION['dStatus'] = "hit";
    }

    if(!$this->checkScore()) {
      $_SESSION['isPlaying'] = FALSE;
    }
  }

  public function stand(): void {
    $_SESSION['pStatus'] = "stand";

    //Dealer stand if the score >= 17
    if ($_SESSION['dScore']>=17) {
      $_SESSION['isPlaying'] = FALSE;
    //Dealer hit if the score < 17
    } else {
      $dCard = $_SESSION['dCard'];
      $dCard[] = $this->card->drawCard();
      $_SESSION['dCard'] = $dCard;
      $_SESSION['dScore'] = $this->countScore($dCard);
      $_SESSION['dStatus'] = "stand";
    }

    if(!$this->checkScore()) {
      $_SESSION['isPlaying'] = FALSE;
    }
  }

  public function checkScore(): bool {
    $_SESSION['card'] = serialize($this->card);
    if($this->card->count() > (52*0.4)){
      $_SESSION['gameOver'] = FALSE;
    } else {
      $_SESSION['gameOver'] = TRUE;
    }

    if($_SESSION['pScore'] > 21 || $_SESSION['dScore']>21) {
      $_SESSION['isPlaying'] = FALSE;
      if($_SESSION['pScore'] > 21 && $_SESSION['dScore']>21) {
        $_SESSION['pLoseCount']++;
        $_SESSION['dLoseCount']++;
        $_SESSION['winner'] = "lose";
      } else if ($_SESSION['pScore']>21) {
        $_SESSION['dWinCount']++;
        $_SESSION['pLoseCount']++;
        $_SESSION['winner'] = "dealer";
      } else if ($_SESSION['dScore']>21) {
        $_SESSION['pWinCount']++;
        $_SESSION['dLoseCount']++;
        $_SESSION['winner'] = "player";
      }
      return FALSE;
    } else if($_SESSION['pStatus'] == "stand" && $_SESSION['dStatus'] == "stand") {
      $_SESSION['isPlaying'] = FALSE;
      if($_SESSION['pScore'] > $_SESSION["dScore"]) {
        $_SESSION['pWinCount']++;
        $_SESSION['dLoseCount']++;
        $_SESSION['winner'] = "player";
      } else if ($_SESSION['pScore'] < $_SESSION["dScore"]) {
        $_SESSION['dWinCount']++;
        $_SESSION['pLoseCount']++;
        $_SESSION['winner'] = "dealer";
      } else if ($_SESSION['pScore'] == $_SESSION["dScore"]) {
        $_SESSION['drawCount']++;
        $_SESSION['winner'] = "draw";
      }
      return FALSE;
    } else if($_SESSION['pScore'] == 21 || $_SESSION['dScore']==21) {
      if ($_SESSION['pScore'] == 21 && $_SESSION['dScore'] == 21) {
        $_SESSION['drawCount']++;
        $_SESSION['winner'] = "draw";
      } else if ($_SESSION['pScore'] == 21) {
        $_SESSION['pWinCount']++;
        $_SESSION['dLoseCount']++;
        $_SESSION['winner'] = "player";
      } else if ($_SESSION['dScore'] == 21) {
        $_SESSION['dWinCount']++;
        $_SESSION['pLoseCount']++;
        $_SESSION['winner'] = "dealer";
      }
      return FALSE;
    } else if ($_SESSION['gameOver']) {
      $_SESSION['isPlaying'] = FALSE;
      if($_SESSION['pScore'] > 21 || $_SESSION['dScore']>21) {
        if($_SESSION['pScore'] > 21 && $_SESSION['dScore']>21) {
          $_SESSION['pLoseCount']++;
          $_SESSION['dLoseCount']++;
          $_SESSION['winner'] = "lose";
        } else if ($_SESSION['pScore']>21) {
          $_SESSION['dWinCount']++;
          $_SESSION['pLoseCount']++;
          $_SESSION['winner'] = "dealer";
        } else if ($_SESSION['dScore']>21) {
          $_SESSION['pWinCount']++;
          $_SESSION['dLoseCount']++;
          $_SESSION['winner'] = "player";
        }
        return FALSE;
      } else if($_SESSION['pScore'] == 21 || $_SESSION['dScore']==21) {
        if ($_SESSION['pScore'] == 21 && $_SESSION['dScore'] == 21) {
          $_SESSION['drawCount']++;
          $_SESSION['winner'] = "draw";
        } else if ($_SESSION['pScore'] == 21) {
          $_SESSION['pWinCount']++;
          $_SESSION['dLoseCount']++;
          $_SESSION['winner'] = "player";
        } else if ($_SESSION['dScore'] == 21) {
          $_SESSION['dWinCount']++;
          $_SESSION['pLoseCount']++;
          $_SESSION['winner'] = "dealer";
        }
        return FALSE;
      } else {
        $_SESSION['isPlaying'] = FALSE;
        if($_SESSION['pScore'] > $_SESSION["dScore"]) {
          $_SESSION['pWinCount']++;
          $_SESSION['dLoseCount']++;
          $_SESSION['winner'] = "player";
        } else if ($_SESSION['pScore'] < $_SESSION["dScore"]) {
          $_SESSION['dWinCount']++;
          $_SESSION['pLoseCount']++;
          $_SESSION['winner'] = "dealer";
        } else if ($_SESSION['pScore'] == $_SESSION["dScore"]) {
          $_SESSION['drawCount']++;
          $_SESSION['winner'] = "draw";
        }
        return FALSE;
      } 
    } else
      return TRUE;
  }

  public function countScore(array $cards): int {
    $score = 0;
    foreach($cards as $value) {
      $score += $this->getScore($value);
    }

    return $score;
  }

  public function getScore(String $cardName): int {
    $card = explode(" ",$cardName);
    $score = 0;
    if($card[1] == 'jack') {
      $score = 11;
    } else if ($card[1] == 'queen') {
      $score = 12;
    } else if ($card[1] == "king") {
      $score = 13;
    } else if ($card[1] == "ace") {
      $score = 1;
    } else {
      $score = $card[1];
    }

    return $score;
  }

  public function totalCardLeft(): int {
    return $this->card->count();
  }

  public function new() {
    //Unset Session
    session_unset();
    $_SESSION['dWinCount'] = 0;
    $_SESSION['dLoseCount'] = 0;
    $_SESSION['pWinCount'] = 0;
    $_SESSION['pLoseCount'] = 0;
    $_SESSION['drawCount'] = 0;
    $_SESSION['isPlaying'] = TRUE;
    $_SESSION['pStatus'] = "new";
    $_SESSION['dStatus'] = "new";
    $_SESSION['winner'] = 0;
    $_SESSION['gameOver'] = FALSE;
    $_SESSION['card'] = 0;
    $this->deal();
  }
}
