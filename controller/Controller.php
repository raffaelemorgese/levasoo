<?php
  session_start();
  include_once '../model/class/lib/Constant.php';
  //*** ELENCO PATH DEI MODULI DI CLASSE ***
  $CLASSPATH = ['command','lib','command/model/user','command/view/user','command/view/team','command/api','user'];
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
  $uri = new UriDispatch($_SERVER['REQUEST_URI']);
  $uriPath = $uri->getUriDispatch();
  $uriCommand = $uriPath[count($uriPath) - 1];
  !(class_exists($uriCommand, TRUE)) && header('Location: ../user/login');
  //*** REFLECTION BY VARIABLE VALUE ***
  $command = new $uriCommand();
  $command->setUriPath($uriPath);
  $command->isAuth() && $command->execute();
  !is_null($command->getRedirect()) && header("Location: ".$command->getRedirect());
  //***
  exit;
?>