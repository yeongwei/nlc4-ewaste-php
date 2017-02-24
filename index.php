<?php
    include("classes/Helper.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="scripts/jq/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/extend.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <table>
    <tr>
    <td style="width: 30%;">
    <img class = "newappIcon" src="images/newapp-icon.png">
    </td>
    <td>
        <h1 id = "message"><?php echo "Welcome to eWaste Management App"; ?></h1>
        A better way to dispose <span class="blue">eWaste</span>.<br>
        Click <a href="info.php" target="_blank">here</a> to view PHP Info.<br>
        Database Status: <?php
        if (isset($_ENV["VCAP_SERVICES"])) { ?>
        <script type="text/javascript">console.log(<?php echo $_ENV["VCAP_SERVICES"]; ?>)</script>"
        <?php
            $vcap_services = json_decode($_ENV["VCAP_SERVICES"]);
            if (isset($vcap_services->{"compose-for-mysql"})) {
                $db = $vcap_services->{"compose-for-mysql"}[0]->credentials;
                $temp = explode('@',$db->uri);
                $mysql_cred = explode(':',$temp[0]);
                $mysql_db = explode('/',$temp[1]);                
                $mysqli = new mysqli($mysql_db[0],ltrim($mysql_cred[1],"/"),$mysql_cred[2]);
                    if ($mysqli->connect_error) {
                        die('Connect Error (' . $mysqli->connect_errno . ') '
                        . $mysqli->connect_error);
                    }
                echo 'Database connected';
                $mysqli->close();
                
            } else {
                echo "Database configurations invalid.";
            }
        } else {	
            // TODO: Fall back to something useful
            echo "No database bound to the application.";
        }
        ?><br>
        PHP Class Test Result: Inspect element will tell you the answer. <?php 
            $helper = new Helper("Ah-roo!");
        ?> 
    </td>
    </tr>
    </table>
    <div
       class="fb-like"
       data-share="true"
       data-width="450"
       data-show-faces="true">
    </div>
</body>
</html>
