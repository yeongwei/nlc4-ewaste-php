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
    <header>
        <img src="images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        <h3 class="title">Welcome<br><span id="volunteertitle"></span></h3>
    </header>
    <div class="welcome">
    
<?php
$_id = $_GET['_id'];
echo '<button type="button" onclick="location.href=\'volunteer-transaction.php?_id=' . $_id . '\'">TRANSACTION</button><br>'
?>	
        <button type="button" onclick="alert('MODIFY PROMO')">MODIFY PROMO</button><br>
        <button type="button" onclick="alert('STATISTIC')">STATISTIC</button><br>
        <button type="button" onclick="alert('COLLECTION')">COLLECTION</button><br>
    </div>
    <footer class="footer">
        <p style="color: black;">
            <em>Powered by</em>
        </p>
        <img src="images/logo1.png" alt="logo"
            style="width: 80px; height: 40px;">
    </footer>  
</body>
</html>