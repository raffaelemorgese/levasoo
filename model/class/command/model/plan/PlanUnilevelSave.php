<?php
/**
 * Description of PlanUnilevelSave
 *
 * @author biab
 */
class PlanUnilevelSave extends Command {
  public function __construct() {
    $this->cluster='user';
  }

  protected function action() {
    $msg = new SysMsg();
    $plan = new Unilevel();
    $plan->setLevel(mysql_real_escape_string($_POST['level']));
    $plan->setDescription(mysql_real_escape_string($_POST['desc']));
    $mycomm = floatval(preg_replace("/[^-0-9\.]/",".", mysql_real_escape_string($_POST['comm'])));
    $plan->setCommission($mycomm);
    $redirect = 'user/fancymessage';
    if ($plan->getLevel()>0&&$plan->getDescription()!=''&&$plan->getCommission()>0)
      if ($plan->save())
        $redirect = 'user/addplanunilevel';
      else 
        Session::setObj(Session::SYSMSG, $msg->setMessage('Inserimento piano Unilevel fallito.')->setType(SysMsg::MSG_CRITICAL));
    else
      Session::setObj(Session::SYSMSG, $msg->setMessage('Tutti i campi sono obbligatori. Inserimento piano Unilevel fallito.')->setType(SysMsg::MSG_CRITICAL));
    //***
    $this->redirect = $redirect;
  }  
    
}
