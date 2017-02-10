<?php
session_start();

include "../classes/Auction.php";
include "../classes/dbConnect.php";
include '../publicHTML/navHeader.php';
include "../classes/Bid.php";
include '../classes/Functions.php';




echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Auction Search Results</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';

$rawCategory = $_GET['category'];
if(strcmp($_GET['category'],'All')==0){
    $category = '*';
}
else{
    $category = $_GET['category'];
}

$zipcode = $_GET['zipcode'];
if(isset($_SESSION['userPK'])){
    $userPK = $_SESSION['userPK'];
}
else{
    $userPK = -1;
}

if(!isset($_GET['listingType'])){
    $listingType = 1;
}
else{
    //1 for active, 0 for inactive
    $listingType = $_GET['listingType'];
}

//echo "$userPK <br/>";
if(strcmp($_GET['category'],'All')==0 and $_GET['zipcode']==''){
    $sql = "SELECT * FROM auction_system.Auction
            WHERE auctionOwnerFK != $userPK
            AND `active` = $listingType
            ORDER BY dateCreated DESC";
}
else if (strcmp($_GET['category'],'All')==0 ){
    $sql = "SELECT * FROM auction_system.Auction
        WHERE auctionOwnerFK != $userPK
        AND zipcode = '$zipcode'
        AND `active` = $listingType
        ORDER BY dateCreated DESC";
}
else if ($_GET['zipcode']==''){
    $sql = "SELECT * FROM auction_system.Auction
        WHERE auctionOwnerFK != $userPK
        AND category = '$category'
        AND `active` = $listingType
        ORDER BY dateCreated DESC";
}
else {
    $sql = "SELECT * FROM auction_system.Auction
        WHERE auctionOwnerFK != $userPK
        AND category = '$category'
        AND zipcode = '$zipcode'
        AND `active` = $listingType
        ORDER BY dateCreated DESC";
}

//echo "$sql <br/>";
//        && WHERE zipCode LIKE $zipcode

//display buttons as to whether current or expired auctions should be displayed
//button for Current Auctions
echo "
      <div style=\"text-align:center;\">
      <a href=\"auctionSearchResults.php?category=$rawCategory&zipcode=$zipcode&listingType=1\" class=\"myButton\">Show Active Auctions</a>
      </div>
      <br/>
      ";
echo "<br/>";

//button for Expired Auctions
echo "
      <div style=\"text-align:center;\">
      <a href=\"auctionSearchResults.php?category=$rawCategory&zipcode=$zipcode&listingType=0\" class=\"myButton\">Show Completed Auctions</a>
      </div>
      <br/>
      ";
echo "<br/>";

$result=mysqli_query($conn, $sql);
$currentAuction = "";
$num_results = mysqli_num_rows($result);
if($result->num_rows > 0) {
    if($listingType == 0){
        echo "<h2>Completed Auctions:</h2>";
    }
    else{
        echo "<h2>Active Auctions:</h2>";
    }
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        //$row = $result->fetch_assoc();
        echo"<i>Auction $i of $num_results:</i>";
        $currentAuction = new Auction($row);
        echo $currentAuction->displayAuctionHTML();
        if($listingType == 0){
            echo "<h2>Winning bid: " . getFormattedLowBid($currentAuction,$conn) . "</h2>";
        }
        else{
            echo "<h2>Current low bid: " . getFormattedLowBid($currentAuction,$conn) . "</h2>";
        }

        echo "<br/>";


        /*
        //TEST SECTION BEGIN!
        echo "<br/> Test section begins here!";

        $bidPK = $currentAuction->getLowBid();

        if(is_null($bidPK)){
            echo "bidPK is null";
        }
        else{
            echo $currentAuction->toString();
            echo "</br>bidPK: " . $bidPK;
            $sql = "SELECT * FROM auction_system.Bid
                    WHERE bidPK = $bidPK";
            $result = mysqli_query($conn, $sql);
            $num_results = mysqli_num_rows($result);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    print_r($row);
                    print "<br/><br/> Trying to instantiate Bid object...";
                    $myBidObject = new Bid($row);
                    //echo $myBidObject->displayBidHTML();
                    $lowBidAmt = $myBidObject->getBidAmt();
                    echo $lowBidAmt;
                    //return $lowBidAmt;
                }
            } else {
                echo "Error in trying to get bid amount";
                //return false;
            }
        }
        //END TEST SECTION!
        */


        $currentPK = $currentAuction->getAuctionPK();

        //print a Bid Now button if user is logged in
        if(isset($_SESSION['userPK'])) {
            //if expired auctions are displaying, do not print bid button;
            if ($listingType == 0){
                //do nothing
            }
            else{
                echo "
                <div style=\"text-align:center;\">
                <a href=\"createBidForm.php?auctionPK=$currentPK\" class=\"myButton\">Place Bid</a>
                </div>
                ";
            }


        }
        //print a Log In Now button if user is not logged in
        else{
            echo "
            <div style=\"text-align:center;\">
            <a href=\"login.php\" class=\"myButton\">Log in to bid!</a>
            </div>
            ";
        }

        $i+=1;

        echo"<br/>";
        echo "<hr class='style1'/>";
    }
    /*
    $row = $result->fetch_assoc();
    $currentAuction = new Auction($row);
    echo $currentAuction->displayAuctionHTML();
    */
}
else{
    echo "No $category auctions found for zip code $zipcode";
}
echo    '
        </div>
        ';
include '../publicHTML/Footer.php';

