<?php
    include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/jq/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>scripts/index.js"></script>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/volunteer.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/index.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">Welcome Merchant</div>
    <div class="volunteer-welcome">
    
<?php
$_id = $_GET['_id'];
echo '<button type="button" class="location-row" onclick="location.href=\'volunteer-transaction.php?_id=' . $_id . '\'">TRANSACTION</button><br>'
?>	
        <button type="button" class="location-row" onclick="alert('MODIFY PROMO')">MODIFY PROMO</button><br>
        <button type="button" class="location-row" onclick="alert('STATISTIC')">STATISTIC</button><br>
        <button type="button" class="location-row" onclick="alert('COLLECTION')">COLLECTION</button><br>
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