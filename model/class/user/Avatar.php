<?php
/**
 * Description of Avatar
 *
 * @author biab
 */
class Avatar {
  const MAX_FILE_SIZE =         '2Mb';
  private $allowedExts =        array("jpg", "jpeg", "png", "gif");
  private $allowedFileType =    array("image/jpeg", "image/pjpeg", "image/png", "image/gif");
  private $maxFileSize =        2000000;
  private $avatarFile;
  
  public function __construct($avatarFile) {
    $this->avatarFile = $avatarFile;
  }
  
  public function isValidType(){
    return in_array($this->avatarFile["type"], $this->allowedFileType);
  }

  public function isValidExtension(){
    $extension = end(explode(".", $this->avatarFile["name"]));
    return in_array($extension, $this->allowedExts);
  }
  
  public function isValidSize(){
    return $this->avatarFile["size"] <= $this->maxFileSize;
  }
  
  public function noErrorDetected(){
    return $this->avatarFile["error"] === 0;
  }
  
  public function save($name){
    switch ($this->avatarFile['type']){
      case 'image/jpeg':
        $tempAvatar = imagecreatefromjpeg($this->avatarFile["tmp_name"]);
        break;
      case 'image/png':
        $tempAvatar = imagecreatefrompng($this->avatarFile["tmp_name"]);
        break;
      case 'image/gif':
        $tempAvatar = imagecreatefromgif($this->avatarFile["tmp_name"]);
        break;
    }
    return imagepng($tempAvatar, UriDispatch::getBaseDir().'avatar/'.$name.'.png');
  }

  
}
