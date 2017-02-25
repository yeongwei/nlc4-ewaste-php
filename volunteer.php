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
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">Welcome Merchant</div>
    <br>
    <div class="volunteer-welcome">
        <a href="<?php echo BASE_URL; ?>volunteer-transaction.php?_id=<?php echo @$_GET["_id"]; ?>" class="location-row">TRANSACTION</a>
        <a href="#" class="location-row">COLLECTION</a>
        <a href="#" class="location-row">MODIFY PROMO</a>
        <a href="#" class="location-row">STATISTIC</a>
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