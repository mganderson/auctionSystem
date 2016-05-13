<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header('Location: ../publicHTML/login.php');
}

include "../classes/Auction.php";
include "../classes/Bid.php";
include "../classes/Functions.php";
include "../classes/dbConnect.php";
include '../publicHTML/navHeader.php';


echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Bid Placed!</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';

$userPK = $_SESSION["userPK"];
$bidPK = $_GET['bidPK'];
$sql = "SELECT * FROM auction_system.Bid WHERE bidPK = $bidPK";
//echo "$sql <br/>";
$result=mysqli_query($conn, $sql);
$num_results = mysqli_num_rows($result);
if($result->num_rows > 0) {
    echo "<h2>Bid placed!</h2>";
    while ($row = $result->fetch_assoc()) {
        //$row = $result->fetch_assoc();
        $currentBid = new Bid($row);

        //creates an Auction object so that you can access auction details
        $currentAuctionID = $currentBid->getAuctionID();
        $sql2 = "SELECT * FROM auction_system.Auction WHERE auctionPK = $currentAuctionID";
        $result2=mysqli_query($conn, $sql2);
        $row2 = $result2->fetch_assoc();
        $currentAuction = new Auction($row2);
        echo "
              <div class='info-text'>
              <br/>
              On auction <b> \"" . $currentAuction->getTitle() . "\"</b>:
              </div>
              ";

        //display bid information by invoking displayBidHTML method of Bid object
        echo $currentBid->displayBidHTML();
        //echo "<h2>Current low bid: " . getFormattedLowBid($currentAuction,$conn) . "</h2>";
        echo "<br/>";

        //determine whether bid is low bid or not
        $sql3 = "SELECT lowBidFK FROM auction_system.Auction WHERE auctionPK = $currentAuctionID";
        $result3=mysqli_query($conn, $sql3);
        //print_r($result3);
        $row3=$result3->fetch_assoc();
        //print_r($row3);
        $lowBidFK = $row3['lowBidFK'];
        //display message as to whether this bid is low bid
        if($lowBidFK == $currentBid->getBidID()){
            echo "
                 <img class = \".img\" src=\"../images/happy-128.png\"/>
                 <br/>
                 <div class=\"form-title\"><h2>You're low bid!</h2></div>
                 ";
        }
        else{
            echo "
                 <img class = \".img\" src=\"../images/crying-128.png\"/>
                 <br/>
                 <div class=\"form-title\"><h2>You've been outbid!</h2></div>
                 ";
            echo "
                 <div style=\"text-align:center;\">
                 <a href=\"createBidForm.php?auctionPK=$currentAuctionID\" class=\"myButton\">Bid again!</a>
                 </div>
                 <br/>
        ";
        }
    }
    /*
    $row = $result->fetch_assoc();
    $currentAuction = new Auction($row);
    echo $currentAuction->displayAuctionHTML();
    */
}
else{
    echo "No bids found<br/> Your userID: " . $userPK;
    echo "<br/>Your SQL query: " . $sql;
}
echo    '
        </div>
        ';
include '../publicHTML/Footer.php';
