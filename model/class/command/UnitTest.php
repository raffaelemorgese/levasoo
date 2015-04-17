<?php
/**
 * Description of UnitTest
 *
 * @author biab
 */
class UnitTest extends Command {
  public function __construct() {
    $this->cluster = 'user';
  }
  
  protected function action() {
    $t = new Team();
    $a=$t->getAllTeam();
  }
}
