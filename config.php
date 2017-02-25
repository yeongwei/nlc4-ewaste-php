<?php
/**
 * Global configurations
 * Variables here should be named with the scheme $_<variable_name>
 */
$_developmentServerRootFolder = "/var/www/html";
$_developmentProjectFolder = "/nlc4-ewaste-php/";
$_timezone = "Asia/Kuala_Lumpur";

if ($_SERVER["DOCUMENT_ROOT"] == $_developmentServerRootFolder) {
    define("PROJECT_FOLDER", $_developmentProjectFolder);
    define("DEVELOPMENT", true);
} else {
    define("PROJECT_FOLDER", "/");
    define("DEVELOPMENT", false);
}

date_default_timezone_set($_timezone);
?>