<?php
class Helper {
    public function __construct($txt) {
    }

    public static function isDevelopment() {
        if (DEVELOPMENT == true) 
            return true;
        else 
            return false;
    }
}
?>