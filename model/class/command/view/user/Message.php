<?php
/**
 * Description of Message
 *
 * @author biab
 */
class Message extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }
  
  protected function action() {
    $this->addParameter('opacity', '1');
    $this->pageToView = "message";
    parent::action();
  }
  
  public function isAuth() {
    return TRUE;
  }
}
