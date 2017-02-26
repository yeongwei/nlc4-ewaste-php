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
        <div id="chartContainer" style="position: relative; overflow: hidden; width: 100%; height: 350px"></div>
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
         <div class="location-list">
             <a href="http://indiatoday.intoday.in/story/retrospective-execution-of-e-waste-rule-to-throttle-growthica/1/890922.html" class="location-row">Retrospective execution of e-waste rule to throttle growth: ICA</a>
             <a href="https://www.reddit.com/r/Documentaries/comments/5vw009/toxicity_life_at_agbobloshie_the_worlds_largest/" class="location-row">ToxiCity: Life at Agbobloshie, the world's largest e-waste dump in Ghana (2016) • r/Documentaries</a>
             <a href="http://economictimes.indiatimes.com/news/environment/pollution/turning-e-waste-to-electricity-iit-madras-innovation-waits-for-takers/articleshow/57334316.cms" class="location-row">Turning e-waste to electricity: IIT Madras innovation waits for takers</a>
         </div>            
    <div class="footer">
        <div class="footer-text">Powered by</div>
        <div class="footer-image">
            <a href="<?php echo BASE_URL; ?>index.php"><img class="" src="<?php echo BASE_URL; ?>images/logo1.png"/></a>
        </div>
    </div>
    </body>
</html>
