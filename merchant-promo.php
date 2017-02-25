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
    
    $sql = "select 
            promo.volunteer_id as volunteer_id, usr.company as company,
            promo.promotion_text as promo_text, promo.start_date as start_date, promo.expiry_date as expiry_date,
            usr.email as email, usr.phone as phone, usr.address as address, usr.city as city, usr.postcode as postcode,
            usr.state as state, usr.latitude as latitude, usr.longitude as longitude
            from ewaste_promo as promo join ewaste_user as usr on usr._id = promo.volunteer_id
            where promo.volunteer_id = " . @$_GET["id"];
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/jq/jquery-3.1.1.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCkRI_Emw5Zc73676jS2K8ZUakThPaS2w"></script>
    <script type="text/javascript">
        var destinationLatLng = "<?php echo $row["latitude"] ?>,<?php echo $row["longitude"] ?>"
    </script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/merchant-promo.js"></script>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/merchant-promo.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
        <div class="header-image">
            <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
            <div class="title-desc"><?php echo $row["company"]; ?></div>
        </div>
    </div>
    <div class="promo-container">
        <div class="promo-text"><?php echo $row["promo_text"]; ?></div>
        <div class="promo-date">Start: <b><?php echo $row["start_date"]; ?></b> End: <b><?php echo $row["expiry_date"]; ?></b></div>
        <div class="promo-address">
            <?php echo $row["address"]; ?>, <?php echo $row["city"]; ?>, <?php echo $row["postcode"]; ?>, <?php echo $row["state"]; ?>
        </div>
        <div class="promo-contacts"><?php echo $row["phone"]; ?> / <?php echo $row["email"]; ?></div>
    </div>
    <div class="map-container">
        <div class="map-actual" id="map-actual"></div>
    </div>
    <div class="footer">
        <div class="footer-text">Powered by</div>
        <div class="footer-image">
            <a href="<?php echo BASE_URL; ?>index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
        </div>
    </div>
</body>
</html>