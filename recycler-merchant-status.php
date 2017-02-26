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
        die ( "Connection failed: " . $mysqli->connect_error );
    }

    $_id = @$_GET['_id'];
    $city = @$_GET['city'];
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/jq/jquery-3.1.1.js"></script>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/recycler-merchant-status.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
        <div class="header-image">
            <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        </div>
        <div class="title-desc">Merchant Weight Status</div>
        <div class="merchant-status">
        <form action="recycler-merchant-status.php" id="recycler-city">
            <div id="label_input">  
                <div class="city-label">Select a City and Click Submit</div> 
                <select id="city-select" name="city" id="city">
            <?php
            // To update insert query from form
            $sql = "select distinct city from ewaste_user where _role = 'volunteer'";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
                    <option value="<?php echo $row['city']; ?>"><?php echo $row['city']; ?></option>
            <?php 
                }
            }
            ?>            
                </select>
            </div>            
            <input type="hidden" name="_id" id="_id" value="<?php echo $_id; ?>"/>
            <input type="submit" value="Submit" class="blue-right-btn"/>
        </form>
        <div id="results-title">Search Results</div>
            <div id="results-table">
                <div class="results-row">
                    <div class="header">Merchant</div>
                    <div class="header">Current / Max (kg)</div>
                    <div class="header">Status (%)</div>
                    <div class="header">Action</div>
                </div>
<?php
$sql= "select usr.company as company, company_desc, image_path, sum_weight, sum_weight/50 * 100 as percent_full, volunteer_id, status
from (select volunteer_id, status, sum(weight) sum_weight from ewaste_trx  where ((status = 'available') OR (status='requested' and recycler_id = " . $_id .")) 
group by volunteer_id, status) trx, ewaste_user usr
where trx.volunteer_id = usr._id
and usr.city =  '" . $city . "'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
                <div class="results-row">
                    <div class="col"><?php echo $row['company']; ?></div>
                    <div class="col"><?php echo number_format($row['sum_weight'] / 50, 2, '.', ''); ?></div>
                    <div class="col"><?php echo number_format($row['percent_full'], 2, '.', ''); ?></div>
                    <div class="col">
                    <?php if ($row['status'] == 'available') {
                        $url = BASE_URL . "update_collection.php?volunteer_id=" . $row['volunteer_id'] . "&recycler_id=" . $_id . "&city=" . $city;
                    ?>
                    <a href="<?php echo $url; ?>">collect</a>
<?php
                    } else {
                        echo $row['status'];
                    }
?>
                    </div>
                </div>
<?php 
    }
}
?>
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