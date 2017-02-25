<?php
/**
 * Global configurations
 */
if ($_SERVER["DOCUMENT_ROOT"] == "/var/www/html") {
    define("PROJECT_FOLDER", "/nlc4-ewaste-php");
} else {
    define("PROJECT_FOLDER", "/");
}
?>