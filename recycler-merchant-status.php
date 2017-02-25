<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="scripts/jq/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/extend.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
    <script>
    function updateMerchantStats() {
        var x = document.getElementById("city").value;
        document.getElementById("ttl-merchant").innerHTML = "2"; /*put total machants found here*/
        /* document.getelementbyclass("volunteer-status").*  change the table contents here*/
    }
    </script>
</head>
<body>
    <header>
        <img src="images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        <h3 class="title">Merchant Weight Status</h3>
    </header>
    <div id="merchant-status">
    <form action="recycler-merchant-status.php" id="recycler-city">
        <div id="label_input">  
            <label for="city">City</label> 
            <select name="city" id="city" onchange="updateMerchantStats()">
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
    </form>
    <hr>
    <br>
    <p>There are <span id="ttl-merchant">6</span> mechants ready for collection</p>
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
// To update insert query from form
$sql = "select usr.company as company, company_desc, image_path, sum_weight, sum_weight/50 * 100 as percent_full
from 
   (select volunteer_id, sum(weight) sum_weight from ewaste_trx 
    where status = 'available'
    group by volunteer_id) trx, ewaste_user usr
where trx.volunteer_id = usr._id
and usr.city = '" . $city . "'";
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
        echo '        collect';
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
    <footer class="footer">
        <p style="color: black;">
            <em>Powered by</em>
        </p>
        <img src="images/logo1.png" alt="logo"
            style="width: 80px; height: 40px;">
    </footer>
</body>
</html>