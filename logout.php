<?php
    include("classes/Authentication.php");
    $authentication = new Authentication($redirectToLogin = false);
    $authentication->logout();
?>