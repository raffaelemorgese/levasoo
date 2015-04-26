<?php
/**
 * Description of UriDispatch
 *
 * @author biab
 */
class UriDispatch {
  
  public static function getUriDispatch() {
    $arrUri = array();
    $reqUri = $_SERVER['REQUEST_URI'];
    $arrUri = explode('/', ltrim($reqUri,'/'.ROOT_SITO.'/'));
    return $arrUri;
  }
  
  public static function getBaseUri() {
    $baseUri = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/'.ROOT_SITO.'/';
    return $baseUri;
  }
  
  public static function getBaseDir() {
    $baseUri = $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/';
    return $baseUri;
  }
  
  public static function redirectToLocation($uri) {
    return header('Location: '.self::getBaseUri().$uri);
  }
  
  public static function getFullUri($uri) {
    return self::getBaseUri().$uri;
  }
}
