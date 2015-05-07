<?php
  session_start();
  include_once '../model/class/lib/Constant.php';
  //*** ELENCO PATH DEI MODULI DI CLASSE ***
  $CLASSPATH = ['command','lib','plan','user','team',
                'command/api',
                'command/model/user','command/model/plan',
                'command/view/user','command/view/team','command/view/plan'];
  //***
  spl_autoload_register('privateAutoload');
  function privateAutoload($class_name)
  { 
    loadResouce($class_name, 0);
  }
  function loadResouce($res, $idx)
  {        
    global $CLASSPATH;
    if ($idx===count($CLASSPATH)) return;
    $filename = $_SERVER["DOCUMENT_ROOT"]."/".ROOT_SITO."/model/class/".$CLASSPATH[$idx]."/".$res.".php";
    file_exists($filename)?require_once $filename:loadResouce($res, $idx+1);
  }
  //***
  $uriPath = UriDispatch::getUriDispatch();
  $uriCommand = $uriPath[1];
  !(class_exists($uriCommand, TRUE)) && UriDispatch::redirectToLocation('user/login');
  //*** REFLECTION BY VARIABLE VALUE ***
  $command = new $uriCommand();
  $command->setUriPath($uriPath);
  $command->isAuth() && $command->execute();
  !is_null($command->getRedirect()) && UriDispatch::redirectToLocation($command->getRedirect());
  //***
  exit;
?>