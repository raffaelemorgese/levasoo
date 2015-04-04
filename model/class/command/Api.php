<?php
/**
 * Description of Api
 *
 * @author biab
 */
abstract class Api extends Command {

  public function isAuth() 
  {
      if (isset($_SESSION["utente"]))
      {
          $utente = unserialize($_SESSION["utente"]);
          $dt = new DateTime();
          $now = $dt->format('Y-m-d H:i:s');
          //L'utente deve effettuare il login ogni ora
          //per simulare la scadenza di un token
          if ((strtotime($now) - strtotime($utente->getLastLogin())) > 60*60)
          {
            $utente->logout();
            return FALSE;
          }
          $this->redirect = NULL;
          return TRUE;
      }
      return FALSE;
  }
  
}
