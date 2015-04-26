<?php
/**
 * Description of Welcome
 *
 * @author biab
 */
class Welcome extends Api {
  protected function action() 
  {
      echo json_encode('Hello World!');
  } 
  
}
