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
      $msg = new SysMsg();
      $rdrct = "user/message";
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
            Session::setObj(Session::SYSMSG, $msg->setMessage('Benvenuto '.$user->getNome().' '.$user->getCognome())->setType(SysMsg::MSG_OK)->addParameter('useravatar', $user->getAvatarUrl()));
            $rdrct = "user/welcome";
          }
          else
            Session::setObj(Session::SYSMSG, $msg->setMessage('Username/Password errati. Login fallito.')->setType(SysMsg::MSG_CRITICAL));
      }
      else
        Session::setObj(Session::SYSMSG, $msg->setMessage('Username/Password non inseriti. Login fallito.')->setType(SysMsg::MSG_ALERT));
      //***
      $this->redirect = $rdrct;
    }  
    
    
}
