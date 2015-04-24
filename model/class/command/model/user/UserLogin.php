<?php
/**
 * Description of UserLogin
 *
 * @author biab
 */
class UserLogin extends Command {
  public function __construct() {
    $this->cluster = 'user';
  }

  protected function action() {
      if ($_POST['username']!="" && $_POST['password']!="")
      {
          //Autenticazione Utente
          $user = new Utente();
          $user->setUsername(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
          $user->setPassword(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
          $user->login();
          //Pone in sessione user (se autenticato)e message 
          if ($user->isAutenticated())
          {
            Session::setObj(Session::UTENTE, $user);
            Session::setObj(Session::SYSMSG, 'Benvenuto '.$user->getNome().' '.$user->getCognome());
          }
          else
            Session::setObj(Session::SYSMSG, 'Username/Password errati. Login fallito.');
      }
      else
        Session::setObj(Session::SYSMSG, 'Username/Password non inseriti. Login fallito.');
      //***
      $this->redirect = "user/message";
    }  
    
    
}
