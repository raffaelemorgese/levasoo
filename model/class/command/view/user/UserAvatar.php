<?php
/**
 * Description of UserAvatar
 *
 * @author biab
 */
class UserAvatar extends Command {
  public function __construct() {
    $this->cluster = "user";
    $this->redirect = NULL;
  }

  protected function action() {
    try {
      $idntwrkr = $this->uriPath[count($this->uriPath)-1];
    }
    catch (Exception $exc) {
      $idntwrkr = BASE_AVATAR_ID;
    }
    //Check file
    $avfile = UriDispatch::getBaseDir().'avatar/'.$idntwrkr.'.png';
    $idntwrkr = file_exists($avfile)?$idntwrkr:BASE_AVATAR_ID;
    //***
    header("Content-type: image/png");
    readfile(UriDispatch::getBaseUri().'avatar/'.$idntwrkr.'.png');
  }    
    
}
