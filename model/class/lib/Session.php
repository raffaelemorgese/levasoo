<?php
/**
 * Description of Session
 *
 * @author biab
 */
class Session {
  const UTENTE                            = 'utente';
  const SYSMSG                            = 'sysmsg';

  public static function setObj($label, $obj) {
    $_SESSION[$label] = serialize($obj);
  }
  
  public static function getObj($label) {
    return unserialize($_SESSION[$label]);
  }
  
  public static function isSetObj($label) {
    return isset($_SESSION[$label]);
  }
  
  public static function destroyObj($label) {
    $_SESSION[$label] = NULL;
  }
}
