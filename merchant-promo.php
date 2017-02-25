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
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">TGIF Friday's 1Utama</div>
    <img src="images/tgif25discount.jpg" alt="tgif">
    <div id="tgif-google-map"></div><!-- Insert map here --> 
    <p><i>Casual chain restaurant with a festive vibe serving beer, cocktails and a wide menu of Americant food.</i></p>
    <p><strong>Business Hours: </strong> Open Now 11AM - 11PM</p>
    <p><strong>Location: </strong> G203A/205/206, Ground Floor, 1 Utama Shopping Centre, 1, Lebuh Bandar Utama, Bandar Utama, 47800 Petaling Jaya, Selangor, Malaysia</p>
    <p><strong>Tel: </strong> +60377294822</p>
    <p><strong>Website: </strong><a href="https://www.fridays.com.my" class="tgif-url">www.fridays.com.my</a></p>
    </div>
    <div class="footer">
        <div class="footer-text">Powered by</div>
        <div class="footer-image">
            <a href="<?php echo BASE_URL; ?>index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
        </div>
    </div>
</body>
</html>