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
</head>
<body>
    <header>
        <img src="images/BackgoundEcoEnvcrop.jpg" alt="BackgoundEcoEnvcrop">
        <h3 class="title">Transaction</h3>
    </header>
    <form action="/add_records.php" id="addrecords">
        <h3>Add New Records</h3>
        <hr>
        <br>
        <label for="weight">Enter weight of items (in kg)</label>
        <input type="text" name="weight" id="weight">
        <br>
        <label for="weight">Donor Name ( leave null for anonymous)</label>
        <input type="text" name="donor" id="donor">
        <br>        
        <input type="submit" value="Submit" class="blue-right-btn">
        <br>
    </form>
    <br>
    <div id="volunteer-status">
        <h3>Current List</h3>
        <hr>
        <p><strong>Status: </strong><span id="volunteer-status">In-Progress</span></p>
        <hr>
        <div id="output">
        <table class="volunteer-status">
        <tr>
            <th>Action</th><th>Record Number</th><th>Weight (kg)</th><th>Date of Transaction</th>
        </tr>
        <tr>
            <td>
                <img src="images/edit_icon.png" alt="edit" style="width:10px;height:10px;">|
                <img src="images/delete_icon.png" alt="edit" style="width:10px;height:10px;">
            </td>
            <td>
                KR-1
            </td>
            <td>
                0.58
            </td>
            <td>
                24/02/2017 12:00PM
            </td>
        </tr>
        <tr>
            <td>
                <img src="images/edit_icon.png" alt="edit" style="width:10px;height:10px;">|
                <img src="images/delete_icon.png" alt="edit" style="width:10px;height:10px;">
            </td>
            <td>
                KR-2
            </td>
            <td>
                0.25
            </td>
            <td>
                24/02/2017 03:00PM
            </td>
        </tr>
        <tr>
            <td>
                <img src="images/edit_icon.png" alt="edit" style="width:10px;height:10px;">|
                <img src="images/delete_icon.png" alt="edit" style="width:10px;height:10px;">
            </td>
            <td>
                KR-3
            </td>
            <td>
                0.85
            </td>
            <td>
                25/02/2017 11:00AM
            </td>
        </tr>
        </table>
        <hr>
        <table class="volunteer-status">
            <tr>
                <td><strong>Total Current Weight</strong></td><td><span id="transaction-ttl-weight" align="right">1.68kg</span></td>
            </tr>
        </table>
        </div>
        <br><button type="button" onclick="alert('View History')" class="blue-right-btn">View History</button><br>
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