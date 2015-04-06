<?php
/**
 * Description of UtenteGo
 *
 * @author biab
 */
class UtenteGo extends Utente {
  protected       $goid;
  protected       $datecreated;
  public function __construct($goid = 0) {
    parent::__construct();
    $this->goid = $goid;
    $this->datecreated = NULL;
    //Create query
    $dbQuery = "SELECT * FROM go_utenti ";
    $dbQuery.= "WHERE go_id = '". $goid ."'";
    $gouser = $this->access->select($dbQuery);
    if ($gouser)
    {
      $this->goid               = $goid;
      $this->id                 = $gouser[0]['rp_id'];
      $this->nome               = $gouser[0]['go_firstname'];
      $this->cognome            = $gouser[0]['go_lastname'];
      $this->email              = $gouser[0]['go_email'];
      $this->avatarUrl          = $gouser[0]['go_avatar'];
      $this->datecreated        = $gouser[0]['date_created'];
    }
  }
  
  public function setGoId($goid) {
    $this->goid = $goid;
  }
  
  public function hereIam() {
    return $this->id > 0;
  }

  public function saveAsGoUser()
  {
    if (!empty($this->goid)) {
      $dbQuery = "INSERT INTO go_utenti ";
      $dbQuery.= "(go_id, rp_id, go_firstname, go_lastname, go_email, go_avatar, date_created ";
      $dbQuery.= ") VALUES ( ";
      $dbQuery.= "'".$this->goid."',";
      $dbQuery.= $this->id.",";
      $dbQuery.= "'".$this->nome."', ";
      $dbQuery.= "'".$this->cognome."', ";
      $dbQuery.= "'".$this->email."', ";
      $dbQuery.= "'".$this->avatarUrl."', ";
      $dbQuery.= "'".date('Y-m-d H:i:s')."') ";
      //***
      $this->access->insert($dbQuery);
    }
  }
  
}
