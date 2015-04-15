<?php
/**
 * Description of Viewer
 *
 * @author biab
 */
class Viewer extends Command {
  protected $showContentOnly;
  private $parameters;
  protected $pageToView;
  public function __construct() {
    $this->redirect = NULL;
    $this->showContentOnly = FALSE;
    $this->parameters = array();
  }

  public function setShowContentOnly($val=FALSE) {
    $this->showContentOnly = $val;
  }
  
  public function setParameters($params = array()) {
    $this->parameters = $params;
  }
  
  protected function action() {
    $pv = new PageViewer();
    $pv->setShowContentOnly($this->showContentOnly);
    $pv->setParameters($this->parameters);
    $pv->setPage($this->pageToView);
    $pv->execute();
  }  
  
}
