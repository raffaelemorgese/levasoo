<?php
/**
 * Description of FbUtente
 *
 * @author biab
 */
class FbUtente extends Utente {

  public function __construct($fbid = 0) {
    $this->data['fbid']           = 0;
    $this->data['firstname']      = '';
    $this->data['lastname']       = '';
    $this->data['email']          = '';
    $this->data['avatarurl']      = '';
    $this->data['datecreated']    = null;
    //Create query
    $dbQuery = "SELECT * FROM fb_customers ";
    $dbQuery.= "WHERE fb_id = ". $fbid;
    $fbcust = database::fetch(database::query($dbQuery));
    if (!empty($fbcust))
    {
      $this->data['fbid']         = $fbid;
      $this->data['id']           = $fbcust['lc_id'];
      $this->data['firstname']    = $fbcust['fb_firstname'];
      $this->data['lastname']     = $fbcust['fb_lastname'];
      $this->data['email']        = $fbcust['fb_email'];
      $this->data['avatarurl']    = 'https://graph.facebook.com/'.$fbid.'/picture';
      $this->data['datecreated']  = $fbcust['date_created'];
    }
  }
  
  public function hereIam()
  {
    return $this->data['id'] > 0;
  }

  public function saveAsFbCustomer()
  {
    if (!empty($this->data['fbid'])) {
      $dbQuery = "INSERT INTO fb_customers ";
      $dbQuery.= "(fb_id, lc_id, fb_firstname, fb_lastname, fb_email, date_created ";
      $dbQuery.= ") VALUES ( ";
      $dbQuery.= database::input($this->data['fbid']).",";
      $dbQuery.= database::input($this->data['id']).",";
      $dbQuery.= "'".database::input($this->data['firstname'])."', ";
      $dbQuery.= "'".database::input($this->data['lastname'])."', ";
      $dbQuery.= "'".database::input($this->data['email'])."', ";
      $dbQuery.= "'".database::input(date('Y-m-d H:i:s'))."') ";
      //***
      database::query($dbQuery);
    }
  }
  
}
