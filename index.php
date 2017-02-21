<!DOCTYPE html>
<html>
<head>
    <title>eWaste Management App</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css" />
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
                $mysql_uri = $db->uri;
                try {
                    $dbh = new PDO($mysql_uri);
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            } else {
                echo "Database configurations invalid.";
            }
        } else {	
            // TODO: Fall back to something useful
            echo "No database bound to the application.";
        }
        ?>
    </td>
    </tr>
    </table>
</body>
</html>