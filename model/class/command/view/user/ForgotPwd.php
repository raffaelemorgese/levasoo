<?php

/**
 * Description of ForgotPwd
 *
 * @author biab
 */
class ForgotPwd extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->pageToView = 'forgotpwd';
    parent::action();
  }  
}
