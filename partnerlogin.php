<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("views/common.php"); ?>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/partnerlogin.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>e-Cycle</title>
</head>
<body>
    <div class="main-container">
        <div class="header-image">
            <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        </div>
        <div class="title-desc">Sign-In Page</div>
<?php 
    $error = @$_GET['error'];
    if ($error == "true")
	echo "<h2> user not found </h2>"
?>        
        <div class="location-list">
        <?php
        ?>
        <form action="login_action.php" id="recycler-city">
        <label class="email" for="email">Fill in you Email and Click Submit</label>
        <div class="input-container">
            <input class="input" type="text" name="email" id="email">
        </div>
        <div class="submit-container">     
            <input type="submit" id="submitBtn">
        </div>
        </form>
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