<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/collection.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/index.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
</head>
<body>
    <div class="main-container">
    <div class="header-image">
        <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
    </div>
    <div class="title-desc">Merchant Weight Status</div>
    <br>
    <div class="collection">
    <h3>Collection Status</h3>
    <hr>
    <table class="collection-status">
        <tr>
            <th>Merchant</th><th>Weight (kg)</th><th>Status</th><th>Request</th>
        </tr>
        <tr>
            <td>
                Merchant A
            </td>
            <td>
                5.0
            </td>
            <td>
                Available
            </td>
            <td>
                <a href="#" class="collection-request">collect</a>
            </td>
        </tr>
        <tr>
            <td>
                Merchant B
            </td>
            <td>
                4.8
            </td>
            <td>
                request sent
            </td>
            <td>
                <a href="#" class="collection-request">collect</a>
            </td>
        </tr>
    </table>
    <br>
    <h3>Collection History</h3>
    <hr>
    <table class="collection-history">
        <tr>
            <th>Merchant</th><th>Weight (kg)</th><th>Status</th><th>Date of Collection</th>
        </tr>
        <tr>
            <td>
                Merchant A
            </td>
            <td>
                5.0
            </td>
            <td>
                Completed
            </td>
            <td>
                01/01/2017 11:00AM
            </td>
        </tr>
    </table>
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