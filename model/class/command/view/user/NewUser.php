<?php
/**
 * Description of NewUser
 *
 * @author biab
 */
class NewUser extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->pageToView = "newuser";
    parent::action();
  }  
}
