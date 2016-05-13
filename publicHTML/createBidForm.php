<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header('Location: ../publicHTML/login.php');
}

include "../classes/Auction.php";
include "../classes/dbConnect.php";
include '../publicHTML/navHeader.php';
include "../classes/Bid.php";
include "../classes/Functions.php";




echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <SCRIPT TYPE="text/javascript"> <!-- // copyright 1999 Idocs, Inc. http://www.idocs.com // Distribute this script freely but keep this notice in place function numbersonly(myfield, e, dec) { var key; var keychar; if (window.event) key = window.event.keyCode; else if (e) key = e.which; else return true; keychar = String.fromCharCode(key); // control keys if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) return true; // numbers else if ((("0123456789").indexOf(keychar) > -1)) return true; // decimal point jump else if (dec && (keychar == ".")) { myfield.form.elements[dec].focus(); return false; } else return false; } //--> </SCRIPT>
        <meta charset="UTF-8">
        <title>Place Bid</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">

        ';

$auctionPK = $_GET['auctionPK'];
$_SESSION['currentAuctionPK'] = $auctionPK;
$userPK = $_SESSION['userPK'];
$sql = "SELECT * FROM auction_system.Auction
        WHERE auctionOwnerFK != $userPK
        AND auctionPK = '$auctionPK'
        ORDER BY dateCreated DESC";
$result=mysqli_query($conn, $sql);
$currentAuction = "";
$num_results = mysqli_num_rows($result);
if($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        $currentAuction = new Auction($row);
        $i+=1;
    }
    $maxBid = $currentAuction->getMaxBidAmt();
    $formattedLowBid = getFormattedLowBid($currentAuction, $conn);
    ;
    echo "
        <form  action =\"../formHandlers/CreateBidHandler.php?auctionPK=$auctionPK\" method=\"POST\">

        <div class=\"form-title\"><h2>Place Bid</h2></div>
        <div class=\"info-text\">Maximum bid: <b> $$maxBid.00 </b></div>
        <div class=\"info-text\">Current low bid: <b>$formattedLowBid</b></div>
        <input  class=\"form-field\" type=\"number\" name=\"bidAmt\" min=\"1\" maxlength=\"10\" onKeyPress=\"return numbersonly(this, event)\"/>

        <div class=\"submit-container\">
        <input class=\"submit-button\" type=\"submit\" value=\"Submit\" />
        </div>
        </form>
    ";
    echo "<h2>Auction details:</h2>";

    echo $currentAuction->displayAuctionHTML();
    echo "<h2>Current low bid: " . getFormattedLowBid($currentAuction, $conn) . "</h2>";
    echo "<br/>";
    /*
    $row = $result->fetch_assoc();
    $currentAuction = new Auction($row);
    echo $currentAuction->displayAuctionHTML();
    */
    /*
    echo "</div>
    <form class=\"info-container\" action =\"../formHandlers/CreateBidHandler.php\" method=\"POST\">

        <div class=\"form-title\"><h2>Place Bid</h2></div>

        <div class=\"form-title\">Bid amount</div>
        <!--
        <input class=\"form-field\" type=\"text\" name=\"maxBidAmt\" required><br />
        -->
        <input  class=\"form-field\" type=\"number\" name=\"bidAmt\" min=\"1\" step=\"1\" value=\"0.00\" />

        <div class=\"submit-container\">
        <input class=\"submit-button\" type=\"submit\" value=\"Submit\" />
        </div>
        </form>


    ";
    */
}
else{
    echo "Error - Cannot place bid on auction $auctionPK
    </div>
    ";

}
echo    '
        </div>
        ';
include '../publicHTML/Footer.php';
/*
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Auction</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<form class="form-container" action ="../formHandlers/CreateBidHandler.php" method="POST">

    <div class="form-title"><h2>Place Bid</h2></div>

    <div class="form-title">Job Description</div>
    <!--TODO: query database and display job summary -->
    
    <div class="form-title">Bid amount</div>
    <!--
    <input class="form-field" type="text" name="maxBidAmt" required><br />
    -->
    <input  class="form-field" type="number" name="bidAmt" min="1" step="1" value="0.00" />

    <div class="submit-container">
        <input class="submit-button" type="submit" value="Submit" />
    </div>
</form>
</body>
</html>
