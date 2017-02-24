<?php
class Helper {
    private static $developmentServerRootFolder = "/var/www/html";
    
    public function __construct($txt) {
    }

    public static function isDevelopment() {
        if ($_SERVER["DOCUMENT_ROOT"] == self::$developmentServerRootFolder) 
            return true;
        else 
            return false;
    }
}
?>