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
    
    $sql1 = "select promo.volunteer_id as volunteer_id, promo.promotion_text as promo_text, promo.start_date as start_date, 
            promo.expiry_date as expiry_date from ewaste_promo as promo where promo.volunteer_id = " . @$_GET["id"];
    $result1 = $mysqli->query($sql1);

    $sql2 = "select usr.email as email, usr.phone as phone, usr.address as address, usr.city as city, usr.postcode as postcode,
            usr.state as state, usr.latitude as latitude, usr.longitude as longitude, usr.company as company
             from ewaste_user usr where usr._id = " . @$_GET["id"];
    $result2 = $mysqli->query($sql2);
    $rows2 = $result2->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/jq/jquery-3.1.1.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCkRI_Emw5Zc73676jS2K8ZUakThPaS2w"></script>
    <script type="text/javascript">
        var destinationLatLng = "<?php echo $rows2["latitude"] ?>,<?php echo $rows2["longitude"] ?>"
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
            <div class="title-desc"><?php echo $rows2["company"]; ?></div>
        </div>
    </div>
    <div class="promo-container">
    <?php
    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
    ?>
        <div class="promo-text"><b>PROMO</b>: <?php echo $row1["promo_text"]; ?></div>
        <div class="promo-date">Start: <b><?php echo $row1["start_date"]; ?></b> End: <b><?php echo $row1["expiry_date"]; ?></b></div>
    <?php
    }
    ?>
        <div class="promo-address">
            <?php echo $rows2["address"]; ?>, <?php echo $rows2["city"]; ?>, <?php echo $rows2["postcode"]; ?>, <?php echo $rows2["state"]; ?>
        </div>
        <div class="promo-contacts"><?php echo $rows2["phone"]; ?> / <?php echo $rows2["email"]; ?></div>
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