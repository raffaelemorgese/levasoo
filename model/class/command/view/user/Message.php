<?php
/**
 * Description of Message
 *
 * @author biab
 */
class Message extends Viewer {
  protected function action() {
    $this->showContentOnly = TRUE;
    $this->pageToView = "message";
    parent::action();
  }
  
  public function isAuth() {
    return TRUE;
  }
}
