<?php
/**
 * Description of Login
 *
 * @author biab
 */
class Login extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->pageToView = "login";
    parent::action();
  }  
}
