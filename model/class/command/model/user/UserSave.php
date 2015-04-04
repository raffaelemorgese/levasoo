<?php
/**
 * Description of UserSave
 *
 * @author biab
 */
class UserSave extends Command {
  public function __construct() {
    $this->cluster='user';
  }

  protected function action() {
    //Autenticazione Utente
    $user = new Utente();
    $user->setNome(mysql_real_escape_string($_POST['nome']));
    $user->setCognome(mysql_real_escape_string($_POST['cognome']));
    $user->setEmail(mysql_real_escape_string($_POST['email']));
    $user->setUsername(mysql_real_escape_string($_POST['username']));
    $user->setPassword(mysql_real_escape_string($_POST['password']));
    if ($user->getNome()!=''&&$user->getCognome()!=''&&
          $user->getEmail()!=''&&$user->getUsername()!=''&&$user->getPassword()!='')
    {
        if ($user->save())
        {
            $user->login();
            //Pone in sessione user (se autenticato)e message 
            if ($user->isAutenticated())
              Session::setObj(Session::UTENTE, $user);
            //***
            Session::setObj(Session::SYSMSG, 'Inserimento utente avvenuto correttamente.');
        }
        else
          Session::setObj(Session::SYSMSG, 'Inserimento utente fallito.');
    }
    else
      Session::setObj(Session::SYSMSG, 'Tutti i campi sono obbligatori. Inserimento utente fallito.');
    //***
    $this->redirect = "message";
  }  
    
    
}
