<?php
/**
 * Description of Unilevel
 *
 * @author user
 */
class Unilevel {
    const             NULL_LEVEL        = -1;
    const             MAP_LEVEL         = 'level';
    const             MAP_DESCRIPTION   = 'description';
    const             MAP_COMMISSION    = 'commission';
    protected         $id;
    protected         $datecreated;
    protected         $level;
    protected         $description;
    protected         $commission;
    protected         $unilevelPlan;

    public function  __construct($id=0){
      $this->id = $id;
      $this->datecreated = date(BASE_DATE_FORMAT);
      $this->level = self::NULL_LEVEL;
      $this->description = '';
      $this->commission = 0;
      $this->access = new Access();
      //if ($this->id===0) return;
      //Load Unilevel plan
      $dbAcc = $this->access;
      $dbQuery = " SELECT * ";
      $dbQuery.= " FROM   unilevel ";
      $dbQuery.= " ORDER BY level ";
      //$dbQuery.= " WHERE  id = ".$this->id;
      //***
      $risult = $dbAcc->select($dbQuery);
      $this->unilevelPlan = $risult;
    }

    public function getLevels(){
      return count($this->unilevelPlan);
    }

    public function getPlan(){
      return $this->unilevelPlan;
    }

    public function setLevel($level){
      $this->level = $level;
    }

    public function getLevel(){
      return $this->level;
    }

    public function setDescription($description){
      $this->description = $description;
    }

    public function getDescription(){
      return $this->description;
    }

    public function setCommission($commission){
      $this->commission = $commission;
    }

    public function getCommission(){
      return $this->commission;
    }

    public function save(){
      $dbAcc = $this->access;
      $query  = " INSERT INTO unilevel ( ";
      $query .= " level, description, commission ";
      $query .= " ) VALUE ( ";
      $query .= $this->level.", ";
      $query .= "'".$this->description."', ";
      $query .= $this->commission.") ";
      //***
      $this->id = $dbAcc->insert($query);
      return $this->id;
    }
    
}
?>
