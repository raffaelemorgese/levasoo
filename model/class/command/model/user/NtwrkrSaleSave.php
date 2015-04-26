<?php
/**
 * Description of NtwrkrSaleSave
 *
 * @author biab
 */
class NtwrkrSaleSave extends Command {
  public function __construct() {
    $this->cluster='user';
  }

  protected function action() {
    $msg = new SysMsg();
    $sale = new Vendita();
    $sale->setNetworker(mysql_real_escape_string($_POST['idntwrkr']));
    $sale->setDateSale(mysql_real_escape_string($_POST['datepicker']));
    $myamount = floatval(preg_replace("/[^-0-9\.]/",".", mysql_real_escape_string($_POST['importo'])));
    $sale->setAmount($myamount);
    if ($sale->getNetworker()>0&&$sale->getDateSale()!=''&&$sale->getAmount()>0)
      $sale->save()?
        Session::setObj(Session::SYSMSG, $msg->setMessage('Inserimento nuova vendita avvenuto correttamente.')->setType(SysMsg::MSG_OK)):
        Session::setObj(Session::SYSMSG, $msg->setMessage('Inserimento nuova vendita fallito.')->setType(SysMsg::MSG_CRITICAL));
    else
      Session::setObj(Session::SYSMSG, $msg->setMessage('Tutti i campi sono obbligatori. Inserimento nuova vendita fallito.')->setType(SysMsg::MSG_CRITICAL));
    //***
    $this->redirect = "user/fancymessage";
  }  
    
}
