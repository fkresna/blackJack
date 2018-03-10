
<!doctype html>
<html lang="en">
<head>
    <title>Honeyfund PHP</title>
    <meta name="description" content="Black Jack">
    <meta name="author" content="Honeyfund Dev">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>


<div class="container">

    <div class="row">
        <div class="col">
            <h1><?= $title ?></h1>
        </div>
    </div>
    <form action="" method="GET">
    <div class="row">
      <div class="form-check">
        <?php
          $isPlaying = $_SESSION['isPlaying'] ?? false; 
          $gameOver = $_SESSION['gameOver'] ?? false;
          if($isPlaying) {
        ?>
        <input class="form-check-input" type="radio" name="action" id="actionNew" value="new" disabled>
        <?php
        } else {
        ?>        
        <input class="form-check-input" type="radio" name="action" id="actionNew" value="new" checked>
        <?php
        }
        ?>
        <label class="form-check-label" for="actionNew">
          New Game
        </label>
      </div>
    </div>
    <div class="row">
      <div class="form-check">
        <?php
          if($isPlaying) {
        ?>
        <input class="form-check-input" type="radio" name="action" id="actionHit" value="hit" checked>
        <?php
        } else {
        ?>
        <input class="form-check-input" type="radio" name="action" id="actionHit" value="hit" disabled>
        <?php
        } 
        ?>
        <label class="form-check-label" for="actionHit">
          Hit
        </label>
      </div>
    </div>
    <div class="row">
      <div class="form-check">
        <?php
          if($isPlaying) {
        ?>
        <input class="form-check-input" type="radio" name="action" id="actionStand" value="stand">
        <?php
        } else {
        ?>
        <input class="form-check-input" type="radio" name="action" id="actionStand" value="stand" disabled>
        <?php
        }
        ?>
        <label class="form-check-label" for="actionStand">
          Stand
        </label>
      </div>
    </div>
    <div class="row">
      <div class="form-check">
        <?php
        if($isPlaying || $gameOver || $action=="new" || $action=="none") {
        ?>
        <input class="form-check-input" type="radio" name="action" id="actionDeal" value="deal" disabled>
        <?php
        } else {
        ?>     
        <input class="form-check-input" type="radio" name="action" id="actionDeal" value="deal" checked>
        <?php 
        } 
        ?>
        <label class="form-check-label" for="actionDeal">
          Deal
        </label>
      </div>
    </div>
    <div class="row">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  <div class="row">
<?php 
    echo "<br/>";   
    if(isset($_SESSION['pScore'])) {
      echo "Player Score: ".$_SESSION['pScore'];
    }
    
    if(isset($_SESSION['pCard'])) {
      echo "<br/>Player Cards:<br/>";
      foreach($_SESSION['pCard'] as $value) {
        echo $value."<br/>";
      }
    }

    if(!$isPlaying) {
      $pWinCount = $_SESSION['pWinCount'] ?? 0;
      $dWinCount = $_SESSION['dWinCount'] ?? 0;
      if($pWinCount>0 || $dWinCount>0) {
        echo "<br/>";
        if(isset($_SESSION['dScore'])) {
          echo "Dealer Score: ".$_SESSION['dScore']."<br/>";
        }

        echo "Dealer Cards:<br/>";
        foreach($_SESSION['dCard'] as $value) {
          echo $value."<br/>";
        }

        if(isset($_SESSION['winner'])) {
          echo "<br/>";
          if($_SESSION['winner'] == "player") {
            echo "Player Wins!<br/>";
          } else if($_SESSION['winner'] == "dealer") {
            echo "Dealer Wins!<br/>";
          } else if($_SESSION['winner'] == "draw") { 
            echo "It's Draw!<br/>";
          } else if($_SESSION["winner"] == "lose") {
            echo "Player and Dealer lose!<br/>";
          }
        }
        echo "<br/>";
        echo "Summary<br/>";
        echo "Total Player Win: ".$_SESSION['pWinCount']."<br/>";
        echo "Total Player Lose: ".$_SESSION['pLoseCount']."<br/>";
        echo "Total Dealer Win: ".$_SESSION['dWinCount']."<br/>";
        echo "Total Dealer Lose: ".$_SESSION['dLoseCount']."<br/>";
        echo "Total Draw: ".$_SESSION['drawCount']."<br/>";
        echo "Total Card left: ".$blackJack->totalCardLeft()."<br/>";

        if(isset($_SESSION['gameOver'])) {
          if($_SESSION['gameOver']) {
            echo "Game Over, 60% of cards already being used, Thank You for playing!";
          }
        }
      }
    } else {
      if(isset($_SESSION['dCard'])) {
        echo "<br/>Total Dealer Cards: ".count($_SESSION['dCard'])."<br/>";
      }
    } 
    
?>
  </div>
  
</div>


<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script src="/assets/app.js"></script>

</body>
</html>
