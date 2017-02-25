<?php
    include("config.php");
    include("classes/Helper.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="scripts/canvas/canvasjs.min.js"></script>
        <script type="text/javascript" src="scripts/jq/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="scripts/script.js"></script>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/style.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/donor.css" />
        <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
        <title>e-Cycle</title>
    </head>

    <?php
        $dataPoints = array(
            array("y" => 3, "label" => "Today"),
            array("y" => 1, "label" => "25-Feb-2017"),
            array("y" => 2, "label" => "24-Feb-2017"),
            array("y" => 1, "label" => "23-Feb-2017"),
            array("y" => 2, "label" => "22-Feb-2017"),
            array("y" => 3, "label" => "21-Feb-2017"),
            array("y" => 4, "label" => "20-Feb-2017"),
            array("y" => 0, "label" => "19-Feb-2017")
        );
    ?>

    <body>
        <div class="main-container">
            <div class="header-image">
                <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
            </div>
            <div class="title-desc">Awareness</div>
        </div>
        <div id="chartContainer" width=100 height=100></div>
        <script type="text/javascript">
             $(function () {
                 var chart = new CanvasJS.Chart("chartContainer", {
                     theme: "theme2",
                     animationEnabled: true,
                     title: {
                         text: "Feeds about e-waste"
                     },
                     data: [
                     {
                         type: "column",
                         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                     }]
                 });
                 chart.render();
             });          
         </script>             
    <div class="footer">
        <div class="footer-text">Powered by</div>
        <div class="footer-image">
            <a href="<?php echo BASE_URL; ?>index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
        </div>
    </div>
    </body>
</html>
