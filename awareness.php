<!DOCTYPE html>
<html>
    <head>
        <title>E-waste Analytics</title>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
