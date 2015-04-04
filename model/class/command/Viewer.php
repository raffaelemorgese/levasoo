<?php
/**
 * Description of Viewer
 *
 * @author biab
 */
class Viewer extends Command {
  protected $pageToView;
  public function __construct() {
    $this->redirect = NULL;
  }

  protected function action() {
    $pv = new PageViewer();
    $pv->setPage($this->pageToView);
    $pv->execute();
  }  
  
}
