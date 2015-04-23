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
    $user = new Utente(Session::getObj(Session::NETWORKER)->getId());
    $user->setNome(filter_var(ucfirst($_POST['nome']), FILTER_SANITIZE_STRING));
    $user->setCognome(filter_var(ucfirst($_POST['cognome']), FILTER_SANITIZE_STRING));
    $user->setEmail(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
    $user->setUsername(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $user->setPassword(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
    $user->update()?
      Session::setObj(Session::SYSMSG, "Utente aggiornato correttamente."):
        Session::setObj(Session::SYSMSG, "Aggiornamento utente fallito.");
    //***
    Session::destroyObj(Session::NETWORKER);
    $this->redirect = "user/message";
  }  
    
}
