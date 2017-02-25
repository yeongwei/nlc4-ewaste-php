<?php
/**
 * Global configurations
 */
$developmentServerRootFolder = "/var/www/html";
$developmentProjectFolder = "/nlc4-ewaste-php";

if ($_SERVER["DOCUMENT_ROOT"] == $developmentServerRootFolder) {
    define("PROJECT_FOLDER", $developmentProjectFolder);
    define("DEVELOPMENT", true);
} else {
    define("PROJECT_FOLDER", "/");
    define("DEVELOPMENT", false);
}
?>