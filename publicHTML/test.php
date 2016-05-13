<?php
session_start();

include '../classes/Auction.php';
include '../classes/AuctionWriter.php';
include '../classes/Bid.php';
include '../classes/BidWriter.php';
include '../classes/dbConnect.php';
include '../classes/Functions.php';

//echo "$userPK <br/>";
$sql = "SELECT * FROM auction_system.Auction WHERE auctionPK = 4 ORDER BY dateCreated DESC";
//echo "$sql <br/>";
$result=mysqli_query($conn, $sql);
$currentAuction = "";
$num_results = mysqli_num_rows($result);
if($result->num_rows > 0) {
    echo "<h2>My Auctions:</h2>";
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        //$row = $result->fetch_assoc();
        echo "<i>Auction $i of $num_results:</i>";
        $currentAuction = new Auction($row);
        print_r($row);
        echo "<br/>";
        echo "HELLO!" . $currentAuction->toString();
        echo $currentAuction->displayAuctionHTML();
        $i += 1;
        echo "<hr/>";

    }

}
else{
        echo "Error";
}

ECHO "YOLO! <br/>";

echo getLowBid($currentAuction, $conn);
echo "<br/>";
echo getFormattedLowBid($currentAuction, $conn);

/*
if(is_null($currentAuction->getLowBid())){
    //return $this->getMaxBidAmt();
    echo "Low bid is null";
}
else {

    echo "<br/> in else clause";
    $bidPK = $currentAuction->getLowBid();
    $sql = "SELECT * FROM auction_system.Bid
            WHERE bidPK = $bidPK";
    $result = mysqli_query($conn, $sql);
    $num_results = mysqli_num_rows($result);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $currentBid = new Bid($row);
            $lowBidAmt = $currentBid->getBidAmt();
            echo $lowBidAmt;
            print_r($row);
            $myBidObject = new Bid($row);
            echo $myBidObject->displayBidHTML();
            //return $lowBidAmt;
        }
    } else {
        echo "Error in trying to get bid amount";
        //return false;
    }

}
*/