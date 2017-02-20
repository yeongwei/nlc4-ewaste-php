<!DOCTYPE html>
<html>
  <head>
    <title>eWaste Management App</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <table>
      <tr>
        <td style='width: 30%;'>
          <img class = 'newappIcon' src='images/newapp-icon.png'>
        </td>
        <td>
          <h1 id = "message"><?php echo "Welcome to eWaste Management App"; ?></h1>
            <p class='description'></p> A better way to dispose <span class="blue">eWaste</span>.
        </td>
      </tr>
    </table>
    <input type="button" onclick="window.open('info.php');" class="btn" value="View PHP info"></input>

<?php 

$vcap_services = json_decode($_ENV["VCAP_SERVICES"]);
if($vcap_services->{'compose-for-mysql'}) {
  $db = @vcap_services->{'compose-for-mysql'}[0]->credentials;
  }
  else {
    echo "Error: No database bound to the application. <br>";
    die();
  }
$mysql_uri = $db->uri;

try {
  $dbh = new PDO($mysql_uri);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

?>

  </body>
</html>
