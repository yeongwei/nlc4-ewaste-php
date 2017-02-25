<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>

    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/donor.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
        <div class="header-image">
            <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        </div>
        <div class="title-desc">Pick Your Nearest Collection Point</div>
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
        
        $sql = "select distinct city from ewaste_user where _role = 'volunteer'";
        $result = $mysqli->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
            <a href="<?php echo BASE_URL; ?>volunteerListing.php?city=<?php echo $row["city"]; ?>" class="location-row"><?php echo $row["city"]; ?></a>
        <?php 
            }
        }
        $mysqli->close ();
        ?>
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