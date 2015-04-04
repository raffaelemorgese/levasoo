<?php
/**
 * Description of Access
 *
 * @author user
 */
class Access {
    private $connessione;
    private $successo = true;
    //***
    public function __construct() {
      $this->connettiDb();
    }
    
    private function connettiDb()
    {   //Connessione Database
        //Parametri di connessione al Database locale
        $host       = "localhost"; 
        $database   = "photosi";
        $utente     = "rmorgese";
        $password   = "rmorgese";
        //***
        $this->connessione = new mysqli($host, $utente, $password, $database);
        $this->successo = (boolean)(!$this->connessione->connect_error);
    }

    public function select($dbQuery) {
      $rs = $this->connessione->query($dbQuery);
      if($rs === false) return FALSE;
      $arr = $rs->fetch_all(MYSQLI_ASSOC);
      return $arr;
    }

    public function insert($dbQuery) {
      if($this->connessione->query($dbQuery) === false) return FALSE;
      $last_inserted_id = $this->connessione->insert_id;
      return $last_inserted_id;
    }

    public function update($dbQuery) {
      if($this->connessione->query($dbQuery) === false) return FALSE;
      $affected_rows = $this->connessione->affected_rows;
      return $affected_rows;
    }

    public function delete($dbQuery) {
      if($this->connessione->query($dbQuery) === false) return FALSE;
      $affected_rows = $this->connessione->affected_rows;
      return $affected_rows;
    }

    public function chiudiDb(){
      $this->connessione->close();
    }
    
    private function sanitize_string($string) {
        return mysql_real_escape_string(trim($string));
    }

}
?>
