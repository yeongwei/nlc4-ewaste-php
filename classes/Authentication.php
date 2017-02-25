<?php
//
require_once $_SERVER["DOCUMENT_ROOT"] . PROJECT_FOLDER . "classes/Helper.php";
require_once $_SERVER["DOCUMENT_ROOT"] . PROJECT_FOLDER . "classes/Facebook2.php";

class Authentication extends Facebook2 {

    private static $defaultLoginUri = "/login.php";
    private static $redirectUri = "/login_redirect.php";
    // private static $redirectUri = "http://www.google.com";

    public function __construct($redirectToLogin = true) {
        parent::__construct();
        if (!parent::hasAccessToken()) {
            if ($redirectToLogin)
                header("Location: " . self::$defaultLoginUri);
        }
    }

    public function login($html = false) {
        $loginUrl = parent::getLoginUrl(self::getRedirectUrl(self::$redirectUri));
        // $loginUrl = parent::getLoginUrl(self::$redirectUri);
        if ($html) echo "Click <a href=\"$loginUrl\"/>here</a> to login.";
    }

    /*
     * This might be someting like a tear down 
     */
    public function logout() {
        unset($_SESSION);
    }

    public function handleRedirect() {
        if (parent::handleRedirect()) {
            // TODO: get user role
            // TODO: get use specific redirect
            echo "Success!!!";
        } else {
            $this->logout();
            echo "Failure!!!";
            // header("Location: " . urlencode(self::$defaultLoginUri . "?error with remote authentication"));
        }
    }

    /*
     * This is for facebook login to redirect
     */
    private static function getRedirectUrl($defaultRedirectUri) {
        if (Helper::isDevelopment())
            return "http://www.foo.com:" . $_SERVER["SERVER_PORT"] . $defaultRedirectUri;
        else
            return "https://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $defaultRedirectUri;
    }
}
?>