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
$recycler_id = $_GET['recycler_id'];
$volunteer_id = $_GET['volunteer_id'];

$sql = "update ewaste_trx set recycler_id = " . $recycler_id ." , status = 'requested'
		where volunteer_id = " . $volunteer_id ." and status = 'available'" ;


if ($mysqli->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close ();

header("Location: /recycler-merchant-status.php");
?>