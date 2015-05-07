<?php
/**
 * Description of AddPlanUnilevel
 *
 * @author biab
 */
class AddPlanUnilevel extends Viewer {
  public function __construct() {
    $this->cluster='user';
    parent::__construct();
  }

  protected function action() {
    $this->showContentOnly = TRUE;
    $this->pageToView = "addplanunilevel";
    parent::action();
  }  
}
