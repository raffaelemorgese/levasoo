<?php
/**
 * Description of UriDispatch
 *
 * @author biab
 */
class UriDispatch {
  private $arrUri = array();
  
  public function __construct($uri) {
    $this->arrUri = explode('/', ltrim($uri,'/'.ROOT_SITO.'/'));
  }
  
  public function getUriDispatch()
  {
    return $this->arrUri;
  }
  
}
