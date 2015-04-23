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
      $parent = $this->uriPath[count($this->uriPath)-4];
      $sponsor = $this->uriPath[count($this->uriPath)-3].' '.$this->uriPath[count($this->uriPath)-2];
      $avatar  = Utente::decode($this->uriPath[count($this->uriPath)-1]);
    }
    catch (Exception $exc) {
      $parent  = NULL_PARENT_ROOT;
      $sponsor = NON_DEFINITO;
      $avatar  = Utente::getDefaultAvatarUrl();
    }
    $this->addParameter('parent',$parent);
    $this->addParameter('sponsor',$sponsor);
    $this->addParameter('avatar',$avatar);
    $this->pageToView = "newuser";
    parent::action();
  }  
}
