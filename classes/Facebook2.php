<?php
require_once $_SERVER["DOCUMENT_ROOT"] . PROJECT_FOLDER .
    "classes/facebook/php-graph-sdk-5.0.0/src/Facebook/autoload.php";
require_once $_SERVER["DOCUMENT_ROOT"] . PROJECT_FOLDER . "classes/Helper.php";

use Facebook\Facebook;

class Facebook2 {
    private static $fbAccessTokenKey = "fbAccessToken";
    private static $fbDefaultGraphVersion = "v2.4";

    private $fb;
    private $fbRedirectLoginHelper;
    private $fbAccessToken;
    private $fbOAuth2Client;

    protected function __construct() {
        session_start(); // Required for using FB SDk
        $permissions = ["email", "public_profile"]; // optional
        $this->fb = new Facebook($this->getFbDetails(), $permissions);
        $this->fbRedirectLoginHelper = $this->fb->getRedirectLoginHelper();
        $_SESSION["FBRLH_state"]=@$_GET["state"];
        $this->fbOAuth2Client = $this->fb->getOAuth2Client();

        $this->getAccessToken(); // http://stackoverflow.com/questions/31347341/the-state-param-from-the-url-and-session-do-not-match
    }

    /*
     * For generating URL for user to login
     */
    protected function getLoginUrl($redirectUri) {
        // return htmlspecialchars($this->fbRedirectLoginHelper->getLoginUrl($redirectUri));
        $fullUrl = $this->fbRedirectLoginHelper->getLoginUrl($redirectUri);
        echo $fullUrl . "<br>";
        return $this->fbRedirectLoginHelper->getLoginUrl($fullUrl);
    }

    /*
     * Assuming that token in session is absolute valid
     */
    protected function hasAccessToken() {
        if ($this->getAccessToken2()) return true;
        else return false;
    }

    /*
     * After successful login via facebook redirect 
     */
    protected function handleRedirect() {
        if ($this->isTokenValid()) {
            // $this->getLongLivedAccessToken();
            return true;
        } else return false;
    }

    // TODO: This name is ulgy
    private function getAccessToken2() {
        if (isset($_SESSION[self::$fbAccessTokenKey])) 
            return $_SESSION[self::$fbAccessTokenKey];
        else return null;
    }

    private function getAccessToken() {
        $accessToken = $this->fbRedirectLoginHelper->getAccessToken();
        echo $accessToken . "<br>";
        return $accessToken;
    }

    private function getAccessTokenMetaData() {
        return $this->fbOAuth2Client->debugToken($this->getAccessToken());
    }

    private function isTokenStillValid() {
        if ($this->getAccessTokenMetaData()->getIsValid()) return true;
        else return false;
    }

    private function isTokenValid() {
        try {
            // $this->getAccessTokenMetaData()->validateAppId(self::getFbAppId());
            return $this->isTokenStillValid();
        } catch (Exception $ex) {
            echo $ex->getMessage() . "<br>";
            return false;
        }
    }

    private function getLongLivedAccessToken() {
        if ($this->fbRedirectLoginHelper->getAccessToken()->isLongLived() == false) {
            saveAccessToken(
                    $this->fbOAuth2Client->getLongLivedAccessToken(
                            $this->fbRedirectLoginHelper->getAccessToken()));
        }
    }

    private function saveAccessToken($accessToken) {
        $_SESSION[self::$fbAccessTokenKey] = (string) $accessToken;
    }

    private static function getFbDetails() {
        if (Helper::isDevelopment()) return self::developmentFbDetails();
        else return self::productionFbDetails();
    }

    private static function getFbAppId() {
        if (Helper::isDevelopment()) return self::developmentFbDetails()[0];
        else return self::productionFbDetails()[0];
    }

    private static function productionFbDetails() {
        return array(
             "app_id" => "1166732620113341",
             "app_secret" => "b354c1945e09370dc035a5f5b2911f1d",
             "default_graph_version" => self::$fbDefaultGraphVersion);
    }
    
    private static function developmentFbDetails() {
        return array(
                "app_id" => "208761059163345",
                "app_secret" => "8eb85c8f21b4f4c649fbb9b6f3841b3d",
                "default_graph_version" => self::$fbDefaultGraphVersion);
    }
}
?>