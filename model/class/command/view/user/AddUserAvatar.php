<?php
/**
 * Description of AddUserAvatar
 *
 * @author biab
 */
class AddUserAvatar extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->showContentOnly = TRUE;
    $this->pageToView = "adduseravatar";
    parent::action();
  }  
}
