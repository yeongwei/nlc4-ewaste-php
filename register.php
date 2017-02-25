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
$sql = "insert into ewaste_user (isactive,age,gender,name,_role,email)
        values (true, 20, 'male', 'Azlin Ghazali', 'donor', 'azlin@persistent.com')";

if ($mysqli->query ( $sql ) === TRUE) {
    echo "User created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close ();
?>