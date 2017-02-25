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
$_id = $_GET['_id'];
$weight = $_GET['weight'];
$donor = $_GET['donor'];
// To update insert query from form
$sql = "select _id from ewaste_user where _role = 'donor' and name = '" . $donor . "' limit 1";
$result = $mysqli->query($sql);

$donor_id = 0 ;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$donor_id = $row["_id"]; 
	}
}
$sql = "insert into ewaste_trx (donor_id,volunteer_id,recycler_id,weight,trx_date,status) values (" . $donor_id .", " . $_id .", null, " . $weight . ", CURRENT_TIMESTAMP(), 'available' )";

if ($mysqli->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close ();

header("Location: /volunteer-transaction.php");
?>