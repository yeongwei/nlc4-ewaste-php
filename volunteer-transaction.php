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
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $_id = @$_GET['_id'];

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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/volunteer-transaction.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
        <div class="header-image">
            <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        </div>
        <div class="title-desc">Transaction for <?php echo $rows["company"]; ?></div>
        <form class="form-add" action="<?php echo BASE_URL; ?>add_records.php" id="addrecords">
            <h3>Add New Entries Below</h3>
            <input type="hidden" name="_id" id="_id" value="<?php echo $_id; ?>"/>
            <label for="weight">Enter weight of items (in kg)</label>
            <input type="text" name="weight" id="weight">
            <label for="weight">Donor Name ( leave null for anonymous)</label>
            <input type="text" name="donor" id="donor"> 
            <input type="submit" value="Submit" class="blue-right-btn">
        </form>
        <div id="volunteer-status">
            <div id="output">
                <div class="row">
                    <div>Action</div>
                    <div>ID</div>
                    <div>Weight (kg)</div>
                    <div>Trx Date</div>
                </div>
                <?php
                $sql = "select _id, weight, trx_date from ewaste_trx where status = 'available' and volunteer_id=" . $_id;
                $result = $mysqli->query($sql);
                $donor_id = 0 ;
            
                $totalWeight = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $totalWeight += $row["weight"];
                ?>
                <div class="row">
                    <div style="text-align: center">
                        <img src="<?php echo BASE_URL; ?>images/edit_icon.png" alt="edit" style="width:30px;height:30px;">;
                        <!--  
                        |<img src="<?php echo BASE_URL; ?>images/delete_icon.png" alt="edit" style="width:10px;height:10px;">';
                         -->
                    </div>
                    <div><?php echo $row["_id"]; ?></div>
                    <div><?php echo $row["weight"]; ?></div>
                    <div><?php echo $row["trx_date"]; ?></div>
                </div>
                <?php
                    }
                }
                ?>
                <div class="row">
                    <div class="summary-title">Total Weight</div>
                    <div class="summary-value"><?php echo $totalWeight; ?></div>
                </div>
            </div>
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