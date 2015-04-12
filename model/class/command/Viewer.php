<?php
/**
 * Description of Viewer
 *
 * @author biab
 */
class Viewer extends Command {
  protected $showContentOnly;
  protected $pageToView;
  public function __construct() {
    $this->redirect = NULL;
    $this->showContentOnly = FALSE;
  }

  public function setShowContentOnly($val=FALSE) {
    $this->showContentOnly = $val;
  }
  
  protected function action() {
    $pv = new PageViewer();
    $pv->setShowContentOnly($this->showContentOnly);
    $pv->setPage($this->pageToView);
    $pv->execute();
  }  
  
}
