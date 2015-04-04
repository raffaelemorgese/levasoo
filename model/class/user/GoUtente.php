<?php
/**
 * Description of GoUtente
 *
 * @author biab
 */
class GoUtente extends Utente {

  public function __construct($goid = 0) {
    $this->data['goid']           = '';
    $this->data['firstname']      = '';
    $this->data['lastname']       = '';
    $this->data['email']          = '';
    $this->data['avatarurl']      = '';
    $this->data['datecreated']    = null;
    //Create query
    $dbQuery = "SELECT * FROM go_customers ";
    $dbQuery.= "WHERE go_id = '". $goid ."'";
    $gocust = database::fetch(database::query($dbQuery));
    if (!empty($gocust))
    {
      $this->data['goid']         = $goid;
      $this->data['id']           = $gocust['lc_id'];
      $this->data['firstname']    = $gocust['go_firstname'];
      $this->data['lastname']     = $gocust['go_lastname'];
      $this->data['email']        = $gocust['go_email'];
      $this->data['avatarurl']    = $gocust['go_avatar'];
      $this->data['datecreated']  = $gocust['date_created'];
    }
  }
  
  public function hereIam()
  {
    return $this->data['id'] > 0;
  }

  public function saveAsGoCustomer()
  {
    if (!empty($this->data['goid'])) {
      $dbQuery = "INSERT INTO go_customers ";
      $dbQuery.= "(go_id, lc_id, go_firstname, go_lastname, go_email, go_avatar, date_created ";
      $dbQuery.= ") VALUES ( ";
      $dbQuery.= "'".database::input($this->data['goid'])."',";
      $dbQuery.= database::input($this->data['id']).",";
      $dbQuery.= "'".database::input($this->data['firstname'])."', ";
      $dbQuery.= "'".database::input($this->data['lastname'])."', ";
      $dbQuery.= "'".database::input($this->data['email'])."', ";
      $dbQuery.= "'".database::input($this->data['avatarurl'])."', ";
      $dbQuery.= "'".database::input(date('Y-m-d H:i:s'))."') ";
      //***
      database::query($dbQuery);
    }
  }
  
}
