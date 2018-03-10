<?php
/**
* BlackJackTest class to handle test for BlackJack class
* 
* @author Freddy <fkresna@gmail.com>
*/
use PHPUnit\Framework\TestCase;
use App\BlackJack;

include __DIR__."/../app/BlackJack.php";

final class BlackJackTest extends TestCase {

  /**
  * Function to test instance of Card
  */
  public function testBlackJack(): void {
    $bj = new BlackJack();
    $this->assertInstanceOf(BlackJack::class,$bj);
  }

  public function testGetScore(): void {
    $bj = new BlackJack();
    $this->assertEquals($bj->getScore("heart 5"),5);
    $this->assertEquals($bj->getScore("diamond jack"),11);
    $this->assertEquals($bj->getScore("jack ace"),1);
    $this->assertEquals($bj->getScore("clover king"),13);
  }

  public function testHit(): void {
    $bj = new BlackJack();
    $bj->hit();
  }
}
?>
