<?php
/**
 * Description of SysMsg
 *
 * @author biab
 */
class SysMsg {
  const     MSG_OK          = 'msg_ok';
  const     MSG_ALERT       = 'msg_alert';
  const     MSG_CRITICAL    = 'msg_critical';
  private   $parameters     = array();
  private   $message;
  private   $type;

  public function setMessage($msg){
    $this->message = $msg;
    return $this;
  }
  
  public function getMessage(){
    return $this->message;
  }
  
  public function setType($type){
    $this->type = $type;
    return $this;
  }
  
  public function getType(){
    return $this->type; 
  }
  
  public function getIconUrl(){
    return UriDispatch::getBaseUri().'view/box/img/'.$this->type.'.png';
  }
  
  public function addParameter($name, $value) {
    $this->parameters[$name] = $value;
    return $this;
  }
  
  public function getParameter($name){
    return $this->parameters[$name];
  }
}
