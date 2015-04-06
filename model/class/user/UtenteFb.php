<?php
/**
 * Description of UtenteFb
 *
 * @author biab
 */
class UtenteFb extends Utente {
  protected       $fbid;
  protected       $datecreated;
  public function __construct($fbid=0) {
    parent::__construct();
    $this->fbid = $fbid;
    $this->datecreated = NULL;
    //Create query
    $dbQuery = "SELECT * FROM fb_customers ";
    $dbQuery.= "WHERE fb_id = ". $fbid;
    $fbuser = $this->access->select($dbQuery);
    if ($fbuser)
    {
      $this->fbid             = $fbid;
      $this->id               = $fbuser[0]['rp_id'];
      $this->nome             = $fbuser[0]['fb_firstname'];
      $this->cognome          = $fbuser[0]['fb_lastname'];
      $this->email            = $fbuser[0]['fb_email'];
      $this->avatarUrl        = 'https://graph.facebook.com/'.$fbid.'/picture';
      $this->datecreated      = $fbuser[0]['date_created'];
    }
  }

  public function setFbId($fbid) {
    $this->fbid = $fbid;
  }
  
  public function hereIam() {
    return $this->id > 0;
  }

  public function saveAsFbUser()
  {
    if (!empty($this->fbid)) {
      $dbQuery = "INSERT INTO fb_utenti ";
      $dbQuery.= "(fb_id, rp_id, fb_firstname, fb_lastname, fb_email, fb_avatar, date_created ";
      $dbQuery.= ") VALUES ( ";
      $dbQuery.= $this->fbid.",";
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
