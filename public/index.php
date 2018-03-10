<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../app/BlackJack.php';
use App\BlackJack;
use App\Card;

$action = $_GET['action'] ?? 'none';
if ($action == 'new')
  $blackJack = new BlackJack(TRUE);
else if($action != "none")
  $blackJack = new BlackJack(FALSE);


switch ($action) {
    
    //Deal new Card
    case 'deal':
      $blackJack->deal();
      break;

    //Draw another card
    case 'hit':
      $blackJack->hit();
      break;
    
    //Stand By
    case 'stand':
      $blackJack->stand();
      break;

    //New Game, Reset everything
    case 'new':
      $blackJack->new();  
      break;
}

$title = 'Freddy Black Jack';


include __DIR__ . '/../views/game.php';
