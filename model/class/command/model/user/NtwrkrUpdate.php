<?php
/**
 * Description of NtwrkrUpdate
 *
 * @author biab
 */
class NtwrkrUpdate extends Command {
  public function __construct() {
    $this->cluster='user';
  }

  protected function action() {
    //Autenticazione Utente
    $msg = new SysMsg();
    $user = new Utente(Session::getObj(Session::NETWORKER)->getId());
    $user->setNome(filter_var(ucfirst($_POST['nome']), FILTER_SANITIZE_STRING));
    $user->setCognome(filter_var(ucfirst($_POST['cognome']), FILTER_SANITIZE_STRING));
    $user->setEmail(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
    $user->setUsername(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $user->setPassword(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
    $user->update()?
      Session::setObj(Session::SYSMSG, $msg->setMessage("Utente aggiornato correttamente.")->setType(SysMsg::MSG_OK)):
        Session::setObj(Session::SYSMSG, $msg->setMessage("Aggiornamento utente fallito.")->setType(SysMsg::MSG_CRITICAL));
    //***
    Session::destroyObj(Session::NETWORKER);
    $this->redirect = "user/fancymessage";
  }  
    
}
