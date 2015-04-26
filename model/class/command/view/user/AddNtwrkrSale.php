<?php
/**
 * Description of AddNtwrkrSale
 *
 * @author biab
 */
class AddNtwrkrSale extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->showContentOnly = TRUE;
    try {
      $idntwrkr = $this->uriPath[count($this->uriPath)-4];
      $fullname = $this->uriPath[count($this->uriPath)-3].' '.$this->uriPath[count($this->uriPath)-2];
      $avatar   = Utente::decode($this->uriPath[count($this->uriPath)-1]);
    }
    catch (Exception $exc) {
      $idntwrkr = NULL_PARENT_ROOT;
      $fullname = NON_DEFINITO;
      $avatar   = Utente::getDefaultAvatarUrl();
    }
    $this->addParameter('idntwrkr',$idntwrkr);
    $this->addParameter('fullname',$fullname);
    $this->addParameter('avatar',$avatar);
    $this->pageToView = "addntwrkrsale";
    parent::action();
  }  
}
