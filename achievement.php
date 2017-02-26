<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("views/common.php"); ?>

        <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/achievement.css" />
        <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
        <title>e-Cycle</title>
    </head>

    <body>
        <div class="main-container">
            <div class="header-image">
                <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
            </div>
            <div class="title-desc">How have E-Cycle Achieved</div>
        </div>
     
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
if ($mysqli->connect_error) {
    die ( "Connection failed: " . $mysqli->connect_error );
}

// To update insert query from form
$sql = "select sum(weight) sum_weight from ewaste_trx";
$result = $mysqli->query($sql);
$sumWeight=0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	$sumWeight=$row['sum_weight'];
    }
}
$mysqli->close ();
?>     
 <div class="title-desc">Raw material recycled</div>
 <table class="volunteer-status">
 <tr>
 	<th>
 	Plastic(KG)
 	</th>
 	<th>
 	Gold(G)
 	</th> 	
 	<th>
 	Silver(G)
 	</th>
 	<th>
 	Copper(KG)
 	</th> 	 	
 </tr>
 <tr>
 <?php 
 	echo ' <td>';
 	echo $sumWeight * 0.5;
 	echo '</td>';
 	echo '<td>';
 	echo $sumWeight * 0.00003;
 	echo '</td>';	
 	echo '<td>';
 	echo $sumWeight * 0.000235;
 	echo '</td>';
 	echo '<td>';
 	echo $sumWeight * 0.096;
 	echo '</td>';
 	?> 	
 </tr> 
 </table>
     
<div class="title-desc">Harmful substance reduced</div>
 <table class="volunteer-status">
 <tr>
 	<th>
 	CO2 emission reduced (tonnes)
 	</th>
 	<th>
 	Soft Ore minning reduced (tonnes)
 	</th> 	
 </tr>
 <tr>
 <?php 
 	echo ' <td>';
 	echo $sumWeight * 0.01;
 	echo '</td>';
 	echo '<td>';
 	echo $sumWeight * 0.028;
 	echo '</td>';	
 	?> 	
 </tr> 
 </table>     
    <div class="footer">
        <div class="footer-text">Powered by</div>
        <div class="footer-image">
            <a href="<?php echo BASE_URL; ?>index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
        </div>
    </div>
    </body>
</html>
