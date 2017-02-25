<?php
    include("config.php");
    include("classes/Authentication.php");
    $authentication = new Authentication($redirectToLogin = false);
    $authentication->logout();
    echo "Logged out at " . date("Y.m.d H.i.s") . ".";
?>