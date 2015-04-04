<?php
/**
 * Description of PageViewer
 *
 * @author user
 */
class PageViewer extends Command {
    private $page;
    public function setPage($page)
    {
        $this->page = $page; 
    }
    
    public function getPage()
    {
      return $this->page; 
    }
  
    protected function action() 
    {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/box/header.php';
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/'.$this->page.'.php';
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_SITO.'/view/box/footer.php';
        $content = ob_get_clean();
        //***
        echo $content;
    }
}

?>
