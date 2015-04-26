<?php
/**
 * Description of FancyMessage
 *
 * @author biab
 */
class FancyMessage extends Viewer{
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }
  
  protected function action() {
    $this->addParameter('opacity', '0');
    $this->showContentOnly = TRUE;
    $this->pageToView = "message";
    parent::action();
  }
  
  public function isAuth() {
    return TRUE;
  }
}
