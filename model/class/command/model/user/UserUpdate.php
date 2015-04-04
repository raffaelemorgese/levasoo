<?php
/**
 * Description of UserUpdate
 *
 * @author biab
 */
class UserUpdate extends Command {
  public function __construct() {
    $this->cluster='user';
  }

  protected function action() {
    //Autenticazione Utente
    $user = new Utente(Session::getObj(Session::UTENTE)->getId());
    $user->setNome(filter_var($_POST['nome'], FILTER_SANITIZE_STRING));
    $user->setCognome(filter_var($_POST['cognome'], FILTER_SANITIZE_STRING));
    $user->setEmail(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
    $user->setUsername(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $user->setPassword(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
    if ($user->update())
    {   //Pone in sessione user
      Session::setObj(Session::UTENTE, $user);
      Session::setObj(Session::SYSMSG, "Utente aggiornato correttamente.");
    }
    else
      Session::setObj(Session::SYSMSG, "Aggiornamento utente fallito.");
    //***
    $this->redirect = "message";
  }  
    
    
}
