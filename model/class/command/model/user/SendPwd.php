<?php
/**
 * Description of SendPwd
 *
 * @author biab
 */
class SendPwd extends Command {
  public function __construct() {
    $this->cluster='user';
  }
  
  protected function action() {
    $userMail = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    if ($this->checkEmailAddress($userMail))
    {
        $user = new Utente();
        $user->setEmail($userMail);
        $pwd = $user->getForgottenPassword();
        if ($pwd!='')
        {
            $msg = 'Salve, abbiamo recuperato la sua password: '.$pwd;
            $mail = new MailMsg();
            $mail->setNome('Servizio');
            $mail->setCognome('Support');
            $mail->setEmailFrom('support@prova.com');
            $mail->setEmailTo($userMail);
            $mail->setEmailReplyTo('support@prova.com');
            $mail->setOggetto('Recupero password.');
            $mail->setMessaggio($msg);
            $mail->sendMail();
            Session::setObj(Session::SYSMSG, 'La password &egrave stata inviata a: '.$userMail);
        }
        else
          Session::setObj(Session::SYSMSG, 'Spiacente, non siamo riusciti a recuperare la sua password.');
    }
    else
      Session::setObj(Session::SYSMSG, 'Spiacente, email errata.');
    //***
    $this->redirect = "message";
  }  

  private function checkEmailAddress($mailAddr)
  {
      return (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $mailAddr));
  }
    
}
