<?php
/**
 * Description of FbUserLogin
 *
 * @author biab
 */
class FbUserLogin extends Command {
  public function __construct() {
    $this->cluster = 'user';
  }
  protected function action() {
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '416201525206070','db946f783550299dcf77faf9f09a8f41' );
// login helper with redirect_uri
$webLang = language::identify();
$helper = new FacebookRedirectLoginHelper('http://www.ituk.it/cinderella/'.$webLang.'/fblogin' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  //Facebook returns an error
  notices::add('errors', language::translate('Facebook_login_error', 'An error occurred during Facebook authentication, please try again later.'));
} catch( Exception $ex ) {
  //Validation fails or other local issues
  notices::add('errors', language::translate('Facebook_login_error', 'An error occurred during Facebook authentication, please try again later.'));
}
//See if we have a session
if (isset($session)) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  $fbid        = $graphObject->getProperty('id');         // To Get Facebook ID
  $fbfullname  = $graphObject->getProperty('name');       // To Get Facebook full name
  $fbfirstname = $graphObject->getProperty('first_name'); // To Get Facebook first name
  $fblastname  = $graphObject->getProperty('last_name');  // To Get Facebook last name
  $fbemail     = $graphObject->getProperty('email');      // To Get Facebook email ID
  //Check if already logged in with Facebook
  //Create new Facebook customer
  $fb_customer = new ctrl_fbcustomer($fbid);
  if (!$fb_customer->hereIam())
  {
    //Save credentials as regular customer
    $objDateTime = new DateTime('NOW');
    $fakepassw   = md5($objDateTime->format('c'));        
    $fakeemail   = $fakepassw.'@facebook.com';
    $fb_customer->data['firstname'] = $fbfirstname; 
    $fb_customer->data['lastname']  = $fblastname; 
    $fb_customer->data['email']     = (isset($fbemail) && strlen($fbemail)>0) ? $fbemail : $fakeemail;
    $fb_customer->save();
    $fb_customer->set_password($fakepassw);
    $fb_customer->data['fbid']      = $fbid;
    //Save Facebook credentials
    $fb_customer->saveAsFbCustomer();
  }
  //Login new customer
  customer::load($fb_customer->data['id']);
  notices::add('success', str_replace(array('%avatarurl', '%firstname', '%lastname'), 
          array('<img src="'.$fb_customer->data['avatarurl'].'" style="border-radius: 30px;" />', $fb_customer->data['firstname'], $fb_customer->data['lastname']), 
          language::translate('success_welcome_user', '%avatarurl Welcome %firstname %lastname.')));
  //Header location after login
  header("Location: http://www.ituk.it/cinderella/index.php");
} else {
  $loginUrl = $helper->getLoginUrl();
  header("Location: ".$loginUrl);
}

  }
}
