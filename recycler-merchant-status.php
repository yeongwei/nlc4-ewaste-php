<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="scripts/jq/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/extend.css" />
    <link rel="shortcut icon" type="image/png" href="images/persistent-favicon.png"/>
    <title>eWaste Management App</title>
    <script>
    function updateMerchantStats() {
        var x = document.getElementById("city").value;
        document.getElementById("ttl-merchant").innerHTML = "2"; /*put total machants found here*/
        /* document.getelementbyclass("volunteer-status").*  change the table contents here*/
    }
    </script>
</head>
<body>
    <header>
        <img src="images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        <h3 class="title">Merchant Weight Status</h3>
    </header>
    <div id="merchant-status">
    <form action="action_page.php" id="recycler-city">
        <div id="label_input">  
            <label for="city">City</label> 
            <select name="city" id="city" onchange="updateMerchantStats()">
                <option value="kl">Kuala Lumpur</option>
                <option value="penang">Penang</option>
                <option value="pj">Petaling Jaya</option>
                <option value="sunway">Sunway</option>
            </select>
        </div>
    </form>
    <hr>
    <br>
    <p>There are <span id="ttl-merchant">6</span> mechants ready for collection</p>
    <hr>
    <table class="volunteer-status">
        <tr>
            <th>Merchant</th><th>Current / max (kg)</th><th>Status (%)</th><th>Request</th>
        </tr>
        <tr>
            <td>
                Auntie Anne's (1U)
            </td>
            <td>
                3.25 / 5
            </td>
            <td>
                65
            </td>
            <td>
                collect
            </td>
        </tr>
        <tr>
            <td>
                Baskin Robbins (1U)
            </td>
            <td>
                4.00 / 8
            </td>
            <td>
                50
            </td>
            <td>
                collect
            </td>
        </tr>
    </table>
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