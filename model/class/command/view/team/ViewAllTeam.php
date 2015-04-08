<?php
/**
 * Description of ViewAllTeam
 *
 * @author biab
 */
class ViewAllTeam extends Viewer {
  public function __construct() {
    $this->cluster='team';
    parent::__construct();
  }

  protected function action() {
    $this->pageToView = 'viewallteam';
    parent::action();
  }  
}
