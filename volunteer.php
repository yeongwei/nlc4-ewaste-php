<?php
    include("config.php");
    include("classes/Helper.php");
    
    $mysqli = null;
    if (Helper::isDevelopment()) {
        $mysqli = @new mysqli("10.211.50.18", "root", "Root#123", "console", "3306");
    } else {
        // Read MySQL credentials from VCAP services and formatting
        $vcap_services = json_decode($_ENV ["VCAP_SERVICES"]);
        $db = $vcap_services->{"compose-for-mysql"}[0]->credentials;
        $temp = explode ("@", $db->uri);
        $mysql_cred = explode (":", $temp [0]);
        $mysql_db = explode ("/", $temp [1]);
    
        // Create DB connection
        $mysqli = new mysqli ($mysql_db[0], ltrim($mysql_cred [1], "/"), $mysql_cred[2], $mysql_db[1]);
    }

    // Check DB connection
    if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error );

    $sql = "select company from ewaste_user where _id = " . @$_GET["_id"];
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/jq/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/index.js"></script>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/volunteer.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">Welcome <?php echo $row["company"]; ?></div>
    <br>
    <div class="volunteer-welcome">
        <a href="<?php echo BASE_URL; ?>volunteer-transaction.php?_id=<?php echo @$_GET["_id"]; ?>" class="location-row">TRANSACTION</a>
		<a href="<?php echo BASE_URL; ?>collection.php?_id=<?php echo @$_GET["_id"]; ?>" class="location-row">COLLECTION</a>

        <a href="#" class="location-row">MODIFY PROMO</a>
        <a href="#" class="location-row">STATISTIC</a>
    </div>
    </div>
    
    <div class="footer">
        <div class="footer-text">Powered by</div>
        <div class="footer-image">
            <a href="<?php echo BASE_URL; ?>index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
        </div>
    </div>
</body>
</html>