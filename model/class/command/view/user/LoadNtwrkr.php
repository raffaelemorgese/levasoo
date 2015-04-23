<?php
/**
 * Description of LoadNtwrkr
 *
 * @author biab
 */
class LoadNtwrkr extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->showContentOnly = TRUE;
    try {
      $idntwrkr = $this->uriPath[count($this->uriPath)-1];
    }
    catch (Exception $exc) {
      $idntwrkr = NULL_PARENT_ROOT;
    }
    Session::setObj(Session::NETWORKER, new Utente($idntwrkr));
    $this->pageToView = "loadntwrkr";
    parent::action();
  }  
}
