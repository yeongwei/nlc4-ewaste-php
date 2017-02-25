<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/recycler.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/index.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">Welcome Recycler</div>
    <div class="recycler-welcome">
<?php
$_id = $_GET['_id'];
echo '<button type="button" class="location-row" onclick="location.href=\'recycler-merchant-status.php?_id=' . $_id . '\'">COLLECTION</button><br>'
?>	    
        <button type="button" class="location-row" onclick="alert('STATISTICS')">STATISTICS</button><br>
        <button type="button" class="location-row" onclick="alert('HISTORY')">HISTORY</button><br>
        <button type="button" class="location-row" onclick="alert('WEIGHT CHECK')">WEIGHT CHECK</button><br>
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