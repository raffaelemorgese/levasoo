<?php
/**
 * Description of UserAvatarSave
 *
 * @author biab
 */
class UserAvatarSave extends Command {
  public function __construct() {
    $this->cluster='user';
  }

  protected function action() {
    //Salvataggio nuovo avatar Utente
    $user = Session::getObj(Session::UTENTE);
    $msg  = new SysMsg();
    $avatar = new Avatar($_FILES["browse"]);
    $this->redirect = "user/adduseravatar";
    $abort = 0;
    if(!($avatar->isValidType()&&$avatar->isValidExtension())){
      Session::setObj(Session::SYSMSG, $msg->setMessage('Formato file immagine non ammesso. [png - jpeg - gif]')->setType(SysMsg::MSG_ALERT));
      $this->redirect = "user/fancymessage";
      $abort = 1;
    }
    if(!$avatar->isValidSize()){
      Session::setObj(Session::SYSMSG, $msg->setMessage('Dimensione file immagine non ammessa. [Max '.Avatar::MAX_FILE_SIZE.']')->setType(SysMsg::MSG_ALERT));
      $this->redirect = "user/fancymessage";
      $abort = 1;
    }
    if(!$avatar->noErrorDetected()){
      Session::setObj(Session::SYSMSG, $msg->setMessage('Impossibile aprire il file immagine. Errore generico.')->setType(SysMsg::MSG_ALERT));
      $this->redirect = "user/fancymessage";
      $abort = 1;
    }
    if(!$abort) $avatar->save($user->getId());
  }  
    
    
}
