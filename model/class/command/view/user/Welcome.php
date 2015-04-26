<?php
/**
 * Description of Welcome
 *
 * @author biab
 */
class Welcome extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }
  
  protected function action() {
    $this->pageToView = "welcome";
    parent::action();
  }
  
  public function isAuth() {
    return TRUE;
  }
}
