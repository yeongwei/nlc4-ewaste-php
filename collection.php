<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/collection.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/index.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">Merchant Weight Status</div>
    <br>
    <div class="collection">
    <h3>Collection Status</h3>
    <hr>
    <table class="collection-status">
        <tr>
            <th>Weight (kg)</th><th>Status</th><th>Transaction Date</th><th>Requested By</th>
        </tr>
<?php
$vcap_services = json_decode ( $_ENV ["VCAP_SERVICES"] );
$db = $vcap_services->{"compose-for-mysql"} [0]->credentials;
$temp = explode ( '@', $db->uri );
$mysql_cred = explode ( ':', $temp [0] );
$mysql_db = explode ( '/', $temp [1] );

// Create DB connection
$mysqli = new mysqli ( $mysql_db [0], ltrim ( $mysql_cred [1], "/" ), $mysql_cred [2], $mysql_db [1] );

// Check DB connection
if ($mysqli->connect_error) {
	die ( "Connection failed: " . $mysqli->connect_error );
}
$sql = "select weight, trx_date, status, company from ewaste_trx trx 
        left outer join ewaste_user usr
        on trx.recycler_id = usr._id
        where volunteer_id=" . $_id;

$result = $mysqli->query($sql);
$donor_id = 0 ;


if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {        
        echo '<tr>';
        echo '    <td>';
        echo $row["weight"];
        echo '    </td>';
        echo '    <td>';
        echo $row["status"];
        echo '    </td>';
        echo '    <td>';
        echo $row["trx_date"];
        echo '    </td>';
        echo '    <td>';
        echo $row["company"];
        echo '    </td>';
        echo '</tr>';
	}
}

?>
    </table>
    <br>
    
    
    <h3>Collection Request</h3>
    <hr>
    <table class="collection-request">
        <tr>
            <th>Recycler Company</th><th>Weight (kg)</th><th>Status</th><th>Action</th>
        </tr>
<?php 
$sql = "select company , status, trx.recycler_id, sum(weight) sum_weight from ewaste_trx trx, ewaste_user usr
where trx.recycler_id = usr._id
and volunteer_id=" . $_id.  " and status in ( 'requested', 'collected')
group by company, status, trx.recycler_id";
    		

$result = $mysqli->query($sql);
$donor_id = 0 ;


if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
      echo ' <tr>';
      echo '      <td>';
      echo $row["company"];
      echo '      </td>';
      echo '      <td>';
      echo $row["sum_weight"];
      echo '      </td>';
      echo '      <td>';
      echo $row["status"];
      echo '      </td>';
      echo '      <td>';
	  if ($row["status"] == 'available')	
      	echo '        <a href="/transfer_collection.php?volunteer_id=' .$_id. '&recycler_id=' . $row["recycler_id"] .'">transfer</a>'; 
	  else 
	  	echo ' ';
      echo '      </td>';
      echo '  </tr>';
	}
}
$mysqli->close ();
?>        
    </table>
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