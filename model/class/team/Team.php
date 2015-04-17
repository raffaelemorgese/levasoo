<?php
/**
 * Description of Team
 *
 * @author biab
 */
class Team {
  
  public static function getAvatarUrl() {
    return UriDispatch::getBaseUri().'view/box/img/team.png';
  }
  
  public function getAllTeam() {
    $query = " SELECT * ";
    $query.= " FROM utenti ";
    $query.= " ORDER BY cognome,parent ASC ";
    $acc = new Access();
    $res = $acc->select($query);
    return $res;
  }

  public function getParentRootTeam() {
    $query = " SELECT * ";
    $query.= " FROM utenti ";
    $query.= " WHERE parent = ".BASE_PARENT_ROOT;
    $query.= " ORDER BY cognome,parent ASC ";
    $acc = new Access();
    $res = $acc->select($query);
    return $res;
  }

  public function getNoParentRootTeam() {
    $query = " SELECT * ";
    $query.= " FROM utenti ";
    $query.= " WHERE parent > ".BASE_PARENT_ROOT;
    $query.= " ORDER BY parent,cognome ASC ";
    $acc = new Access();
    $res = $acc->select($query);
    return $res;
  }
}
