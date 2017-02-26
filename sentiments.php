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
                array("y" => 34, "name" => "Joy", "exploded" => true),
                array("y" => 8, "name" => "Sadness"),
                array("y" => 0, "name" => "Anger"),
                array("y" => 0, "name" => "Disgust"),
                array("y" => 0, "name" => "Fear")
        );
    ?>

    <body>
        <div class="main-container">
            <div class="header-image">
                <img src="<?php echo BASE_URL; ?>images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
            </div>
            <div class="title-desc">Sentiments</div>
        </div>    
        <div id="chartContainer" style="position: relative; overflow: hidden; width: 100%; height: 350px"></div>
        <script type="text/javascript">

            $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme2",
                    animationEnabled: true,
                    title: {
                        text: "e-Cycle feed from Twitters"
                    },
                    data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{name}: <strong>{y}%</strong>",
                        indexLabel: "{name} {y}%",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }
                    ]
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