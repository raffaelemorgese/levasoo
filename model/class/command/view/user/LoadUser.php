<?php
/**
 * Description of LoadUser
 *
 * @author biab
 */
class LoadUser extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->pageToView = "loaduser";
    parent::action();
  }  
}
