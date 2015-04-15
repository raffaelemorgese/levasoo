<?php
/**
 * Description of PageViewer
 *
 * @author user
 */
class PageViewer extends Command {
    private $page;
    private $showContentOnly = FALSE;
    private $parameters = array();
    public function setPage($page)
    {
        $this->page = $page; 
    }
    
    public function getPage()
    {
      return $this->page; 
    }

    public function setShowContentOnly($val=FALSE) {
      $this->showContentOnly = $val;
    }
 
    public function setParameters($params = array()) {
      $this->parameters = $params;
    }
    
    private static function applyParameters($params, $start, $content) {
      if ($start===count($params)) return $content;
      $content = str_replace ('{SNIPPET::'.key($params).'}', $params[key($params)], $content);
      next($params);
      return self::applyParameters($params, $start+1, $content);
    }

    protected function action() 
    {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/box/header.php';
        !$this->showContentOnly && include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/box/menubar.php';
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/'.$this->page.'.php';
        !$this->showContentOnly && include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/box/bottombar.php';
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/box/footer.php';
        $content = ob_get_clean();
        //***
        echo self::applyParameters($this->parameters,0,$content);
    }
}

?>
