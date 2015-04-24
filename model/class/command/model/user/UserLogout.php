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
    Session::destroyObj(Session::UTENTE);
    Session::setObj(Session::SYSMSG, "Logout eseguito correttamente.");
    //***
    $this->redirect = "user/message";
  }  
    
}
