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
    $this->showContentOnly = TRUE;
    try {
      $sponsor = $this->uriPath[count($this->uriPath)-2].' '.$this->uriPath[count($this->uriPath)-1];
    }
    catch (Exception $exc) {
      $sponsor = NON_DEFINITO;
    }
    $this->setParameters(array('sponsor'=>$sponsor));
    $this->pageToView = "newuser";
    parent::action();
  }  
}
