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
</head>
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

if ($result->num_row > 0) {
    while($row = $result->fetch_assoc()) {
        echo "city: " . $row["city"]. "<br>";
    }
} else {
    echo "0 results";
}
$mysqli->close ();
?>
<body>
    <img src="images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    <h2 class="title">Find Your Nearest Collection Point</h2>
    <form action="action_page.php" id="registration">
        <div id="label_input">
            <h3>Pick a City</h3>
            <hr>   
            <label for="city">City Selection</label> 
            <select name="city" id="city">
                <option value="donor">Kuala Lumpur</option>
                <option value="collector">Penang</option>
                <option value="recycler">Petaling Jaya</option>
                <option value="recycler">Sunway</option>
            </select>
            <br>
        </div>
        <br>
        <input type="submit" id="submitBtn">
    </form>
    <div class="footer">
      <p style="color:black;"><em>Powered by</em></p>
      <img src="images/logo1.png" alt="logo" style="width:80px;height:40px;">
    </div>
</body>
</html>