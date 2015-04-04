<?php
/**
 * Description of Command
 *
 * @author user
 */
abstract class Command {
    protected $redirect = 'user/login'; 
    protected $uriPath = array();
    protected $cluster = '';
    abstract protected function action();

    public function execute()
    {
        $this->action();
    }
    
    public function getRedirect()
    {
      return $this->redirect;
    }
    
    public function isAuth()
    {
        return $this->uriPath[0]===$this->cluster;
    }
    
    public function setUriPath($uriPath)
    {
      $this->uriPath = $uriPath;
    }
    
    public function getUriPath()
    {
      return $this->uriPath;
    }
    
}

?>
