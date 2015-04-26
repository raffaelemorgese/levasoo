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
    $msg = new SysMsg();
    $user = new Utente();
    $user->setParent(mysql_real_escape_string($_POST['parent']));
    $user->setNome(mysql_real_escape_string(ucfirst($_POST['nome'])));
    $user->setCognome(mysql_real_escape_string(ucfirst($_POST['cognome'])));
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
            Session::setObj(Session::SYSMSG, $msg->setMessage('Inserimento utente avvenuto correttamente.')->setType(SysMsg::MSG_OK));
        }
        else
          Session::setObj(Session::SYSMSG, $msg->setMessage('Inserimento utente fallito.')->setType(SysMsg::MSG_CRITICAL));
    }
    else
      Session::setObj(Session::SYSMSG, $msg->setMessage('Tutti i campi sono obbligatori. Inserimento utente fallito.')->setType(SysMsg::MSG_ALERT));
    //***
    $this->redirect = "user/message";
  }  
    
    
}
