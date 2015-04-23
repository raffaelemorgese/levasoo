<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utente
 *
 * @author user
 */
class Utente {
    protected         $id;
    protected         $nome;
    protected         $cognome;
    protected         $email;
    protected         $username;
    protected         $password;
    protected         $lastlogin;
    protected         $parent;
    protected         $autenticato;
    protected         $access;
    protected         $avatarUrl;
    
    public function  __construct($id=0)
    {
        $this->id = $id;
        $this->nome = "";
        $this->cognome = "";
        $this->email = "";
        $this->username = "";
        $this->password = "";
        $this->parent = NULL_PARENT_ROOT;
        $this->avatarUrl = UriDispatch::getBaseUri().'view/box/img/avatar.png';
        $this->setAutenticated(false);
        $this->access = new Access();
        if ($this->id===0) return;
        //Load user
        $dbAcc = $this->access;
        $dbQuery = " SELECT nome, cognome, email, ";
        $dbQuery.= " username, password, parent ";
        $dbQuery.= " FROM   utenti ";
        $dbQuery.= " WHERE  id = ".$this->id;
        //Verifica autenticazione utente
        $risult = $dbAcc->select($dbQuery);
        $this->setAutenticated(count($risult) === 1);
        if ($this->autenticato) {
            $this->nome      = $risult[0]['nome'];
            $this->cognome   = $risult[0]['cognome'];
            $this->email     = $risult[0]['email'];
            $this->username  = $risult[0]['username'];
            $this->password  = $risult[0]['password'];
            $this->parent    = $risult[0]['parent'];
        }
    }

    public function getId()
    {
         return $this->id;
    }

    public function setNome($nome)
    {
         $this->nome = $nome;
    }

    public function getNome()
    {
         return $this->nome;
    }

    public function setCognome($cognome)
    {
         $this->cognome = $cognome;
    }

    public function getCognome()
    {
         return $this->cognome;
    }

    public function setEmail($email)
    {
         $this->email = $email;
    }

    public function getEmail()
    {
         return $this->email;
    }

    public function setUsername($uname)
    {
         $this->username = $uname;
    }

    public function getUsername()
    {
         return $this->username;
    }

    public function setPassword($pwd)
    {
         $this->password = $pwd;
    }

    public function getPassword()
    {
         return $this->password;
    }

    public function setParent($parent) {
         $this->parent = $parent;
    }

    public function getParent() {
         return $this->parent;
    }

    public function getLastLogin()
    {
         return $this->lastlogin;
    }

    public function setAutenticated($aut)
    {
         $this->autenticato = $aut;
    }

    public function isAutenticated()
    {
         return $this->autenticato;
    }

    public function login()
    {
       $dbAcc      = $this->access;
       //***
       $dbQuery = " SELECT id, nome, cognome, email, parent ";
       $dbQuery.= " FROM   utenti ";
       $dbQuery.= " WHERE  username = '".$this->username."' ";
       $dbQuery.= " AND    password = '".self::encode($this->password)."' ";
       //***
       //Verifica autenticazione utente
       $risult = $dbAcc->select($dbQuery);
       $this->setAutenticated(count($risult) === 1);
       if ($this->autenticato)
       {
           $this->id        = $risult[0]['id'];
           $this->nome      = $risult[0]['nome'];
           $this->cognome   = $risult[0]['cognome'];
           $this->email     = $risult[0]['email'];
           $this->parent    = $risult[0]['parent'];
           $this->setLoginTime();
       }
    }

    public function logout()
    {
      Session::destroyObj(Session::UTENTE);
    }
    
    public function save()
    {
        $dbAcc = $this->access;
        $query  = " INSERT INTO utenti ( ";
        $query .= " nome, cognome, email, username, password, parent ";
        $query .= " ) VALUE ( ";
        $query .= "'".$this->nome."', ";
        $query .= "'".$this->cognome."', ";
        $query .= "'".$this->email."', ";
        $query .= "'".$this->username."', ";
        $query .= "'".self::encode($this->password)."', ";
        $query .= $this->parent.") ";
        //***
        $this->id = $dbAcc->insert($query);
        return $this->id;
    }
    
    public function update()
    {
        $dbAcc = $this->access;
        $query  = " UPDATE utenti SET ";
        $query .= " nome = '".$this->nome."', ";
        $query .= " cognome = '".$this->cognome."', ";
        $query .= " email = '".$this->email."', ";
        $query .= " username = '".$this->username."', ";
        $query .= " password = '".self::encode($this->password)."', ";
        $query .= " parent = ".$this->parent;
        $query .= " WHERE ";
        $query .= " id = ".$this->id;
        //***
        return $dbAcc->update($query);
    }
    
    public function getForgottenPassword()
    {
       $dbAcc      = $this->access;
       //***
       $dbQuery = " SELECT password ";
       $dbQuery.= " FROM   utenti ";
       $dbQuery.= " WHERE  email = '".$this->email."' ";
       //***
       $risult = $dbAcc->select($dbQuery);
       return $risult?self::decode($risult[0]['password']):'';
    }

    private function setLoginTime() 
    {
        $dt = new DateTime();
        $this->lastlogin = $dt->format('Y-m-d H:i:s');
        $dbAcc = $this->access;
        $query  = " UPDATE utenti SET ";
        $query .= " lastlogin = '".$dt->format('Y-m-d H:i:s')."' ";
        $query .= " WHERE ";
        $query .= " id = ".$this->id;
        //***
        return $dbAcc->update($query);
    }
 
    public function setAvatarUrl($avatarurl) {
      $this->avatarUrl = $avatarurl;
    }

    public function getAvatarUrl() {
      return $this->avatarUrl;
    }
    
    public static function getDefaultAvatarUrl() {
      return UriDispatch::getBaseUri().'view/box/img/avatar.png';
    }
    
    public static function encode($data) {
      return base64_encode($data);
    }

    public static function decode($data) {
      return base64_decode($data);
    }
}
?>
