<?php
/**
 * Description of UserGoLogin
 *
 * @author biab
 */
require_once __DIR__.'/../../../lib/Google/config.php';
require_once __DIR__.'/../../../lib/Google/Google_Client.php';
require_once __DIR__.'/../../../lib/Google/Google_Service.php';
require_once __DIR__.'/../../../lib/Google/Google_Cache.php';
require_once __DIR__.'/../../../lib/Google/Google_Auth.php';
require_once __DIR__.'/../../../lib/Google/Google_IO.php';
require_once __DIR__.'/../../../lib/Google/Google_OAuth2.php';
require_once __DIR__.'/../../../lib/Google/Google_Oauth2Service.php';
//***
class UserGoLogin extends Command {
  public function __construct() {
    $this->cluster = 'user';
  }
  protected function action() {
    $client = new Google_Client();
    $client->setApplicationName('ITUK-Cinderella');
    $client->setClientId('1047071962553-peio8aua5ac0a17s11a116thcr77ag4m.apps.googleusercontent.com');
    $client->setClientSecret('d-XWxzPq11ZrDsh0RsbgFc9k');
    $client->setRedirectUri('http://www.ituk.it/cinderella/gologin');
    $client->setApprovalPrompt('auto');
    $client->setAccessType('offline');
    $oauth2 = new Google_Oauth2Service($client);
    //***
    if (isset($_GET['code'])) {
      $client->authenticate($_GET['code']);
      Session::setObj(Session::TOKEN, $client->getAccessToken());
    }
    //***
    if (Session::isSetObj(Session::TOKEN)) {
      $client->setAccessToken(Session::getObj(Session::TOKEN));
    }
    //***
    if (isset($_REQUEST['error'])) {
      //Google returns an error
      Session::setObj(Session::SYSMSG, 'Errore durante l\'autenticazione con Google, per favore riprovare pi&ugrave; tardi.');
      $this->redirect = 'message';
      exit;
    }
    //***
    if ($client->getAccessToken()) {
      $user = $oauth2->userinfo->get();
      //The access token may have been updated lazily.
      Session::setObj(Session::TOKEN, $client->getAccessToken());
      //***
      $goid        = $user['id'];             // To Get Google ID
      $gofullname  = $user['name'];           // To Get Google full name
      $gofirstname = $user['given_name'];     // To Get Google first name
      $golastname  = $user['family_name'];    // To Get Google last name
      $goemail     = filter_var($user['email'], FILTER_SANITIZE_EMAIL);        // To Get Google email ID
      $goavatar    = filter_var($user['picture'], FILTER_VALIDATE_URL);        // To Get Google avatar
      //Check if already logged in with Google
      //Create new Google user
      $go_user = new UtenteGo($goid);
      if (!$go_user->hereIam())
      { //Save as regular user
        $objDateTime = new DateTime('NOW');
        $fakepassw   = md5($objDateTime->format('c'));        
        $fakeemail   = $fakepassw.'@google.com';
        $go_user->setNome($gofirstname); 
        $go_user->setCognome($golastname); 
        $go_user->setEmail((isset($goemail) && strlen($goemail)>0) ? $goemail : $fakeemail);
        $go_user->setUsername('GoogleUser');
        $go_user->set_password($fakepassw);
        $go_user->save();
        //Save as Google user
        $go_user->setGoId($goid);
        $go_user->setAvatarUrl($goavatar);
        //Save Google credentials
        $go_user->saveAsGoUser();
      }
      //Login user
      Session::setObj(Session::UTENTE, $go_user);
      Session::setObj(Session::SYSMSG, 'Benvenuto '.$go_user->getNome().' '.$go_user->getCognome());
      $this->redirect = 'message';
    } else {
      //Try Google Authentication
      $loginUrl = $client->createAuthUrl();
      $this->redirect = $loginUrl;
    }
  }
}
