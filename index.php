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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/index.css" />
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>images/persistent-favicon.png"/>
    <title>e-Cycle</title>
</head>
<body>
    <div class="main-container">
        <div class="splash-container">
            <a href="awareness.php"><img class="splash-image" 
                src="<?php echo BASE_URL; ?>images/E-WasteTree.jpg" alt="E-WasteTree"></a>
            <div class="splash-details">
                <div class="splash-details-title">Our Mission</div>
                <div class="splash-details-desc">To create awareness &amp; a safe, easy &amp; rewarding way for e-waste disposal.</div>
            </div>
        </div>
        <div class="navigation-container">
            <div class="naivgation-list">
                <div class="navigation-header">FIND US</div>
                <div class="navigation-option"><a href="<?php echo BASE_URL; ?>donor.php">MERCHANT LOCATOR</a></div>
            </div>
            <div class="naivgation-list">
                <div class="navigation-header">PARTNER WITH US</div>
                <div class="navigation-option"><a href="<?php echo BASE_URL; ?>registration.php">REGISTRATION</a></div>
                <div class="navigation-option"><a href="<?php echo BASE_URL; ?>partnerlogin.php">PARTNER LOGIN</a></div>
            </div>
            <div class="naivgation-list">
                <div class="navigation-header">ANALYTICS</div>
                <div class="navigation-option"><a href="<?php echo BASE_URL; ?>awareness.php">AWARENESS</a></div>
                <div class="navigation-option"><a href="<?php echo BASE_URL; ?>sentiments.php">SENTIMENTS</a></div>
                <div class="navigation-option"><a href="<?php echo BASE_URL; ?>achievement.php">ACHIEVEMENT</a></div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-text">Powered by</div>
            <div class="footer-image">
                <a href="index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
            </div>
        </div>
    </div>
</body>
</html>
