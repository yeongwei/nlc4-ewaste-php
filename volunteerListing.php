<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/volunteerListing.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png" />
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
        <div class="header-image">
            <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        </div>
        <div class="title-desc">Merchants available in <?php echo @$_GET["city"]; ?></div>
    </div>
     <div class="location-list">
     <?php
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

        $sql = "select _id, company, company_desc, image_path, promo.promo_count as promo_count 
                from ewaste_user usr left outer join (
                select count(1) promo_count , volunteer_id from 
                ewaste_promo where status = true and start_date < current_timestamp() and current_timestamp() <= expiry_date group by volunteer_id) promo 
                on usr._id = promo.volunteer_id where _role = 'volunteer' and city = '" . @$_GET["city"] . "'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while   ($row = $result->fetch_assoc()) {
    ?>
        <a href="<?php echo BASE_URL; ?>merchant-promo.php?id=<?php echo $row["_id"]; ?>" class="location-row">
            <div class="location-logo"><img src="<?php echo $row["image_path"]; ?>" alt="<?php echo $row["company"]; ?>"/></div>
            <div class="location-details">
                <div class="location-text company"><?php echo $row["company"]; ?></div>
                <div class="location-text desc"><?php echo $row["company_desc"]; ?></div>
                <div class="location-text distance">Distance: <?php echo rand(1, 11); ?> km</div>
    <?php 
        if ($row["promo_count"] > 0) {
    ?>
                <div class="location-text promo"><img src="<?php echo BASE_URL; ?>images/specialOffer.png" alt="specialOffer"/></div>
    <?php
        }
    ?>
            </div>
        </a>
    <?php
         }
        }
        $mysqli->close ();
    ?>
    </div>
    <div class="footer">
        <div class="footer-text">Powered by</div>
        <div class="footer-image">
            <a href="index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
        </div>
    </div>
</body>
</html>