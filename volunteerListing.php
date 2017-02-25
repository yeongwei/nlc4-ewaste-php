<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="scripts/jq/jquery-3.1.1.js"></script>
<script type="text/javascript" src="scripts/script.js"></script>
<link rel="stylesheet" href="styles/style.css" />
<link rel="stylesheet" href="styles/extend.css" />
<link rel="shortcut icon" type="image/png"
	href="images/persistent-favicon.png" />
<title>eWaste Management App</title>
</head>
<body>
	<img src="images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
	<h2 class="title">Find Your Nearest Collection Point</h2>
	<form action="volunteerListing.php" id="registration">
		<div id="label_input">
			<label for="city">Modify Location</label> 
			<select name="city"
				id="city">
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
			</select> <br> 
			<label for="sort">Sort By</label> 
			<select name="sort" id="sort">
				<option value="alphabetical">A-Z</option>
				<option value="alphabeticalDesc">Z-A</option>
				<option value="distance">distance</option>
			</select> <br>
			<hr>
		</div>
		<br> <input type="submit" id="submitBtn">
			
			<table class="volunteer-listing">
				<tr>
					<th style="width: 15%" />
					<th style="width: 70%" />
					<th style="width: 15%" />
				</tr>
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
$city = $_GET['city'];
// To update insert query from form
$sql = "select company, company_desc, image_path, promo.promo_count as promo_count from ewaste_user usr left outer join (select count(1) promo_count , volunteer_id from ewaste_promo where status = true and start_date < current_timestamp() and current_timestamp() <= expiry_date group by volunteer_id) promo on  usr._id = promo.volunteer_id where _role = 'volunteer' and city = '" . $city . "'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";    //"<option value=" . $row["city"]. ">" . $row["city"]. "</option>";
		echo '<td><img src="' . $row["image_path"] . '" alt="' . $row["company"] .'"></td>';
		echo '<td><h2 class="title">' . $row["company"] . '</h2>';
    	echo '<hr style="height:1pt; visibility:hidden;" />';	
		echo '<h3 class="desc">' . $row["company_desc"] . '</h3>';
		echo '<hr style="height:1pt; visibility:hidden;" />';
		echo 'Distance: 2 km';
		echo '</td>';
        if ($row["promo_count"] > 0)
        	echo '<td><img src="images/specialOffer.png" alt="specialOffer"></td>';
        else 
        	echo '<td/>';
		echo "</tr>";			
    		
    }
}
$mysqli->close ();
?>				
				<!-- tr>
					<td><img src="images/ewaste_user/persistent.jpg" alt="persistent"></td>
					<td><h2 class="title">Persistent System Limited</h2>
						<hr style="height:1pt; visibility:hidden;" />
						<h3 class="desc">Software House</h3>
						<hr style="height:1pt; visibility:hidden;" />
						Distance: 2 km
						
					</td>
					<td><img src="images/specialOffer.png" alt="specialOffer"></td>
				</tr>
				<tr>
					<td><img src="images/ewaste_user/tgif.png" alt="tgif"></td>
					<td><h2 class="title">TGI Friday's (1 Utama)</h2>
						<hr style="height:1pt; visibility:hidden;" />
						<h3 class="desc">Burgers Western</h3>
						<hr style="height:1pt; visibility:hidden;" />
						Distance: 1.2 km
						
					</td>
					<td> </td>
				</tr-->
			</table>


	</form>
	<footer class="footer">
		<p style="color: black;">
			<em>Powered by</em>
		</p>
		<img src="images/logo1.png" alt="logo"
			style="width: 80px; height: 40px;">
	</footer>
</body>
</html>