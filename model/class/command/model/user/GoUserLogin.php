<?php
/**
 * Description of GoUserLogin
 *
 * @author biab
 */
class GoUserLogin extends Command {
  public function __construct() {
    $this->cluster = 'user';
  }
  
  protected function action() {
//***
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/config.php');
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/Google/Google_Client.php');
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/Google/Google_Service.php');
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/Google/Google_Cache.php');
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/Google/Google_Auth.php');
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/Google/Google_IO.php');
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/Google/Google_OAuth2.php');
require_once vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_ITUK_LIBRARY . 'gologin/lib/Google/Google_Oauth2Service.php');
//***
$webLang = language::identify();
$client = new Google_Client();
$client->setApplicationName('ITUK-Cinderella');
$client->setClientId('1047071962553-peio8aua5ac0a17s11a116thcr77ag4m.apps.googleusercontent.com');
$client->setClientSecret('d-XWxzPq11ZrDsh0RsbgFc9k');
$client->setRedirectUri('http://www.ituk.it/cinderella/'.$webLang.'/gologin');
$client->setApprovalPrompt('auto');
$client->setAccessType('offline');
$oauth2 = new Google_Oauth2Service($client);
//***
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
}
//***
if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}
//***
if (isset($_REQUEST['error'])) {
  //Google returns an error
  notices::add('errors', language::translate('Google_login_error', 'An error occurred during Google authentication, please try again later.'));
}
//***
if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();
  //The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
  //***
  $goid        = $user['id'];             // To Get Google ID
  $gofullname  = $user['name'];           // To Get Google full name
  $gofirstname = $user['given_name'];     // To Get Google first name
  $golastname  = $user['family_name'];    // To Get Google last name
  $goemail     = filter_var($user['email'], FILTER_SANITIZE_EMAIL);        // To Get Google email ID
  $goavatar    = filter_var($user['picture'], FILTER_VALIDATE_URL);        // To Get Google avatar
  //Check if already logged in with Google
  //Create new Google customer
  $go_customer = new ctrl_gocustomer($goid);
  if (!$go_customer->hereIam())
  {
    //Save credentials as regular customer
    $objDateTime = new DateTime('NOW');
    $fakepassw   = md5($objDateTime->format('c'));        
    $fakeemail   = $fakepassw.'@google.com';
    $go_customer->data['firstname'] = $gofirstname; 
    $go_customer->data['lastname']  = $golastname; 
    $go_customer->data['email']     = (isset($goemail) && strlen($goemail)>0) ? $goemail : $fakeemail;
    $go_customer->save();
    $go_customer->set_password($fakepassw);
    $go_customer->data['goid']      = $goid;
    $go_customer->data['avatarurl'] = $goavatar;
    //Save Google credentials
    $go_customer->saveAsGoCustomer();
  }
  //Login new customer
  customer::load($go_customer->data['id']);
  notices::add('success', str_replace(array('%avatarurl', '%firstname', '%lastname'), 
          array('<img src="'.$go_customer->data['avatarurl'].'" style="border-radius: 30px;" width="50px;" />', $go_customer->data['firstname'], $go_customer->data['lastname']), 
          language::translate('success_welcome_user', '%avatarurl Welcome %firstname %lastname.')));
  //Header location after login
  header("Location: http://www.ituk.it/cinderella/index.php");
} else {
  //Try Google Authentication
  $loginUrl = $client->createAuthUrl();
  header("Location: ".$loginUrl);
}    
  }
}
