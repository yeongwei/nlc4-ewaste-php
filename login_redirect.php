<?php
    include("config.php");
    include("classes/Authentication.php");
    $authentication = new Authentication($redirectToLogin = false);
    $authentication->handleRedirect();
?>