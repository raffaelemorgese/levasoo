<?php
/**
 * Description of UserFbLogin
 *
 * @author biab
 */
require_once __DIR__.'/../../../lib/Facebook/FacebookSession.php';
require_once __DIR__.'/../../../lib/Facebook/FacebookRedirectLoginHelper.php';
require_once __DIR__.'/../../../lib/Facebook/FacebookRequest.php';
require_once __DIR__.'/../../../lib/Facebook/FacebookResponse.php';
require_once __DIR__.'/../../../lib/Facebook/FacebookSDKException.php';
require_once __DIR__.'/../../../lib/Facebook/FacebookRequestException.php';
require_once __DIR__.'/../../../lib/Facebook/FacebookAuthorizationException.php';
require_once __DIR__.'/../../../lib/Facebook/GraphObject.php';
require_once __DIR__.'/../../../lib/Facebook/Entities/AccessToken.php';
require_once __DIR__.'/../../../lib/Facebook/HttpClients/FacebookCurlHttpClient.php';
require_once __DIR__.'/../../../lib/Facebook/HttpClients/FacebookHttpable.php';
require_once __DIR__.'/../../../lib/Facebook/HttpClients/FacebookStreamHttpClient.php';
//***
class UserFbLogin extends Command {
  public function __construct() {
    $this->cluster = 'user';
  }
  protected function action() {
    //Init app with app id and secret
    FacebookSession::setDefaultApplication( '416201525206070','db946f783550299dcf77faf9f09a8f41' );
    //Login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://www.ituk.it/cinderella/fblogin' );
    try {
      $session = $helper->getSessionFromRedirect();
    } catch( FacebookRequestException $ex ) {
      //Facebook returns an error
      Session::setObj(Session::SYSMSG, 'Errore durante l\'autenticazione con Facebook, per favore riprovare pi&ugrave; tardi.');
      $this->redirect = 'message';
      exit;
    } catch( Exception $ex ) {
      //Validation fails or other local issues
      Session::setObj(Session::SYSMSG, 'Errore durante l\'autenticazione con Facebook, per favore riprovare pi&ugrave; tardi.');
      $this->redirect = 'message';
      exit;
    }
    //See if we have a session
    if (isset($session)) {
      //Graph api request for user data
      $request = new FacebookRequest( $session, 'GET', '/me' );
      $response = $request->execute();
      //Get response
      $graphObject = $response->getGraphObject();
      $fbid        = $graphObject->getProperty('id');         // To Get Facebook ID
      $fbfullname  = $graphObject->getProperty('name');       // To Get Facebook full name
      $fbfirstname = $graphObject->getProperty('first_name'); // To Get Facebook first name
      $fblastname  = $graphObject->getProperty('last_name');  // To Get Facebook last name
      $fbemail     = $graphObject->getProperty('email');      // To Get Facebook email ID
      //Check if already logged in with Facebook
      //Create new Facebook user
      $fb_user = new UtenteFb($fbid);
      if (!$fb_user->hereIam()) {
        //Save credentials as regular user
        $objDateTime = new DateTime('NOW');
        $fakepassw   = md5($objDateTime->format('c'));        
        $fakeemail   = $fakepassw.'@facebook.com';
        $fb_user->setNome($fbfirstname); 
        $fb_user->setCognome($fblastname); 
        $fb_user->setEmail((isset($fbemail) && strlen($fbemail)>0) ? $fbemail : $fakeemail);
        $fb_user->setUsername('FacebookUser');
        $fb_user->set_password($fakepassw);
        $fb_user->save();
        //Save as Facebook user
        $fb_user->setFbId($fbid);
        $fb_user->setAvatarUrl($fb_user->getAvatarUrl());
        //Save Facebook credentials
        $fb_user->saveAsFbUser();
      }
      //Login user
      Session::setObj(Session::UTENTE, $fb_user);
      Session::setObj(Session::SYSMSG, 'Benvenuto '.$fb_user->getNome().' '.$fb_user->getCognome());
      $this->redirect = 'message';
    } else {
      //Try Facebook Authentication
      $loginUrl = $helper->getLoginUrl();
      $this->redirect = $loginUrl;
    }
  }
}