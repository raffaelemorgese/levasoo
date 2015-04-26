<?php
/**
 * Description of UserLogout
 *
 * @author biab
 */
class UserLogout extends Command {
  public function __construct() {
    $this->cluster='user';
  }
  
  protected function action() {
    //Logout Utente
    $msg = new SysMsg();
    Session::destroyObj(Session::UTENTE);
    Session::setObj(Session::SYSMSG, $msg->setMessage("Logout eseguito correttamente.")->setType(SysMsg::MSG_OK));
    //***
    $this->redirect = "user/message";
  }  
    
}
