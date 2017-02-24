<?php
    // echo "login_redirect.php";
    include("classes/Authentication.php");
    $authentication = new Authentication($redirectToLogin = false);
    $authentication->handleRedirect();
?>