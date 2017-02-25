<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/jq/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/index.js"></script>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/recycler-merchant-status.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/index.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
    <!-- script>
    function updateMerchantStats() {
        var x = document.getElementById("city").value;
        document.getElementById("ttl-merchant").innerHTML = "2"; /*put total machants found here*/
        /* document.getelementbyclass("volunteer-status").*  change the table contents here*/
    }
    </script-->
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
            <label for="city">City</label> 
            <select name="city" id="city">
            
<?php
// Read MySQL credentials from VCAP services and formatting
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

// To update insert query from form
$sql = "select distinct city from ewaste_user where _role = 'volunteer'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['city']. '">' . $row['city']. '</option>';
    }
}
$mysqli->close ();
?>            
            </select>
        </div>            
<?php
$_id = $_GET['_id'];
echo '<input type="hidden" name="_id" id="_id" value="' . $_id . '">'
?>            
        <!--<input type="submit" value="Submit" class="blue-right-btn">  -->
    </form>
    <hr>
    <br>
    <!-- p>There are <span id="ttl-merchant">6</span> mechants ready for collection</p-->
    <hr>
    <table class="volunteer-status">
        <tr>
            <th>Merchant</th><th>Current / max (kg)</th><th>Status (%)</th><th>Request</th>
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
$city = $_GET['city'];

$sql= "select usr.company as company, company_desc, image_path, sum_weight, sum_weight/50 * 100 as percent_full, volunteer_id, status
from 
   (select volunteer_id, status, sum(weight) sum_weight from ewaste_trx 
    where ((status = 'available') OR (status='requested' and recycler_id = " . $_id .")) 
    group by volunteer_id, status) trx, ewaste_user usr
where trx.volunteer_id = usr._id
and usr.city =  '" . $city . "'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
		echo '<tr>';
        echo '    <td>';
        echo $row['company'];
        echo '    </td>';
        echo '    <td>';
        echo $row['sum_weight'] . ' / 50';
        echo '    </td>';
        echo '    <td>';
        echo $row['percent_full'];
        echo '    </td>';
        echo '    <td>';
        if ($row['status'] == 'available')
        	echo '        <a href="/update_collection.php?volunteer_id=' .$row['volunteer_id']. '&recycler_id=' . $_id . '&city=' . $city. '">collect</a>';
        else
        	echo $row['status'];
        echo '    </td>';
        echo '</tr>';
    }
}
?>
        <!-- tr>
            <td>
                Baskin Robbins (1U)
            </td>
            <td>
                4.00 / 8
            </td>
            <td>
                50
            </td>
            <td>
                collect
            </td>
        </tr-->
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