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
<body>
    <img src="images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    <h2 class="title">Welcome<br><span id="recyclertitle"></span></h2>
    <div class="welcome">
<?php
$_id = $_GET['_id'];
echo '<button type="button" onclick="location.href=\'recycler-merchant-status.php?_id=' . $_id . '\'">COLLECTION</button><br>'
?>	    
        <button type="button" onclick="alert('STATISTICS')">STATISTICS</button><br>
        <button type="button" onclick="alert('HISTORY')">HISTORY</button><br>
        <button type="button" onclick="alert('WEIGHT CHECK')">WEIGHT CHECK</button><br>
    </div>  
    <footer class="footer">
      <p style="color:black;"><em>Powered by</em></p>
      <img src="images/logo1.png" alt="logo" style="width:80px;height:40px;">
    </footer>
</body>
</html>