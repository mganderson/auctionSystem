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
        <title>My Auctions</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';

$userPK = $_SESSION["userPK"];
//Test Section
if(!isset($_GET['listingType'])){
    $listingType = 1;
}
else{
    //1 for active, 0 for inactive
    $listingType = $_GET['listingType'];
}
//End Test Section

//display buttons as to whether current or expired auctions should be displayed
//button for Current Auctions
echo "
      <div style=\"text-align:center;\">
      <a href=\"userAuctions.php?listingType=1\" class=\"myButton\">Show My Active Auctions</a>
      </div>
      <br/>
      ";
echo "<br/>";

//button for Expired Auctions
echo "
      <div style=\"text-align:center;\">
      <a href=\"userAuctions.php?listingType=0\" class=\"myButton\">Show My Completed Auctions</a>
      </div>
      <br/>
      ";
echo "<br/>";


//echo "$userPK <br/>";
$sql = "SELECT * FROM auction_system.Auction
        WHERE auctionOwnerFK = $userPK
        AND `active` = $listingType
        ORDER BY dateCreated DESC";
//echo "$sql <br/>";
$result=mysqli_query($conn, $sql);
$currentAuction = "";
$num_results = mysqli_num_rows($result);
if($result->num_rows > 0) {
    if($listingType == 0){
        echo "<h2>My Completed Auctions:</h2>";
    }
    else{
        echo "<h2>My Active Auctions:</h2>";
    }
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        //$row = $result->fetch_assoc();
        echo"<i>Auction $i of $num_results:</i>";
        $currentAuction = new Auction($row);
        echo $currentAuction->displayAuctionHTML();
        if($listingType == 0){
            if(!empty($currentAuction->getLowBid())){

                echo "
                 <img class = \".img\" src=\"../images/happy-128.png\"/>
                 <br/>
                 <div class=\"form-title\"><h2>Winning bid: " . getFormattedLowBid($currentAuction,$conn) . "</h2></div>
                 ";
                //Go to My Jobs button
                echo "
                 <br/>
                 <div style=\"text-align:center;\">
                 <a href=\"userJobs.php?displayChoice=consumer\" class=\"myButton\">Go to My Jobs</a>
                 </div>
                 <br/>
                ";
            }
            else{
                echo "
                 <img class = \".img\" src=\"../images/crying-128.png\"/>
                 <br/>
                 <div class=\"form-title\"><h2>Auction expired with no bids</h2></div>
                 ";
            }
        }
        else{
            echo "<h2>Current low bid: " . getFormattedLowBid($currentAuction,$conn) . "</h2>";
        }
        echo "<br/>";
        $i+=1;
        echo "<hr class='style1'/>";
    }
    /*
    $row = $result->fetch_assoc();
    $currentAuction = new Auction($row);
    echo $currentAuction->displayAuctionHTML();
    */
}
else{
    if($listingType == 0){
        echo "<h2>No expired auctions found</h2>";
    }
    else{
        echo "<h2>No active auctions found</h2>";
    }
}
echo    '
        </div>
        ';
include '../publicHTML/Footer.php';
