<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="scripts/canvas/canvasjs.min.js"></script>
        <script type="text/javascript" src="scripts/jq/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="scripts/script.js"></script>
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
        <div id="chartContainer"></div>

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
                    }
                    ]
                });
                chart.render();
            });
        </script>
    </body>

</html>
