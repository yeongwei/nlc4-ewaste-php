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

    $_id = @$_GET["_id"];
    $sql = "select usr.email as email, usr.phone as phone, usr.address as address, usr.city as city, usr.postcode as postcode,
            usr.state as state, usr.latitude as latitude, usr.longitude as longitude, usr.company as company
             from ewaste_user usr where usr._id = " . $_id;
    $result = $mysqli->query($sql);
    $rows = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/recycler.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">Welcome <?php echo $rows["company"]; ?></div>
    <br>
    <div class="recycler-welcome">       
        <a href="<?php echo BASE_URL; ?>collection.php" class="location-row">COLLECTION</a>
        <!-- history and collections is the same <a href="#" class="location-row">HISTORY</a>-->
        <a href="<?php echo BASE_URL; ?>recycler-merchant-status.php?_id=<?php echo @$_GET["_id"]; ?>" class="location-row">WEIGHT CHECK</a>
        <a href="#" class="location-row">STATISTICS</a>
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