<?php

require __DIR__ . '/../vendor/autoload.php';

$action = $_GET['action'] ?? 'new';

switch ($action) {

    case 'deal':
        break;

    case 'hit':
        break;

    case 'stand':
        break;

    case 'new':
    default:

}

$title = 'Black Jack';


include __DIR__ . '/../views/game.php';
