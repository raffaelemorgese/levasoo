<?php
/**
 * Description of Vendita
 *
 * @author user
 */
class Vendita {
    protected         $id;
    protected         $networker;
    protected         $datecreated;
    protected         $datesale;
    protected         $amount;
    protected         $access;
    
    public function  __construct($id=0){
      $this->id = $id;
      $this->networker = "";
      $this->datecreated = date(BASE_DATE_FORMAT);
      $this->datesale = date(BASE_DATE_FORMAT);
      $this->amount = 0;
      $this->access = new Access();
      if ($this->id===0) return;
      //Load vendita
      $dbAcc = $this->access;
      $dbQuery = " SELECT * ";
      $dbQuery.= " FROM   vendite ";
      $dbQuery.= " WHERE  id = ".$this->id;
      //***
      $risult = $dbAcc->select($dbQuery);
      $this->networker      = $risult[0]['networker'];
      $this->datecreated    = $risult[0]['datecreated'];
      $this->datesale       = $risult[0]['datesale'];
      $this->amount         = $risult[0]['amount'];
    }

    public function getId(){
      return $this->id;
    }

    public function setNetworker($networker){
      $this->networker = $networker;
    }

    public function getNetworker(){
      return $this->networker;
    }

    public function setDateSale($datesale){
      $this->datesale = $datesale;
    }

    public function getDateSale(){
      return $this->datesale;
    }

    public function setAmount($amount){
      $this->amount = $amount;
    }

    public function getAmount(){
      return $this->amount;
    }

    public function save(){
      $mydate = explode('/', $this->datesale);
      $datesale = new DateTime();
      $datesale->setDate($mydate[2], $mydate[1], $mydate[0]);
      $datesale->setTime(0, 0, 0);
      $dbAcc = $this->access;
      $query  = " INSERT INTO vendite ( ";
      $query .= " networker, datesale, amount ";
      $query .= " ) VALUE ( ";
      $query .= $this->networker.", ";
      $query .= "'".$datesale->format(BASE_DATETIME_FORMAT)."', ";
      $query .= $this->amount.") ";
      //***
      $this->id = $dbAcc->insert($query);
      return $this->id;
    }
    
}
?>
