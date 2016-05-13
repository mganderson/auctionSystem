<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/10/16
 * Time: 6:02 PM
 */
include "../classes/Functions.php";
include "../classes/Auction.php";
include "../classes/dbConnect.php";
include "../classes/Contract.php";
include "../classes/ContractReader.php";
include "../classes/AuctionReader.php";
include "../classes/UserReader.php";
include "../classes/UserAlt.php";
include "../classes/Bid.php";
include "../classes/BidReader.php";
include "../classes/BidWriter.php";

/*
$userPK = 2;
echo "$userPK <br/> <br/>";
$sql = "SELECT * FROM auction_system.Auction WHERE auctionOwnerFK = $userPK";
echo "$sql <br/> <br/>";
$result=mysqli_query($conn, $sql);
print_r($result);
echo "<br/> <br/>";
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    print_r($row);
    echo "<br/> <br/>";
    $currentAuction = new Auction($row);
    echo $currentAuction->getDescription();
}
else{
    echo "No auctions found";
}
*/
/*
$testBW = new BidWriter(4,3,40);

$testBW->__writeToDatabase($conn);

$sql = "SELECT * FROM auction_system.Bid ORDER BY dateCreated DESC";
//echo "$sql <br/>";
$result=mysqli_query($conn, $sql);
if($result->num_rows > 0) {
    echo "<h2>Bid Created Successfully!</h2>";
    $row = $result->fetch_assoc();
    print_r($row);
    echo "<br/><br/>";
    $currentBid = new Bid($row);
    echo $currentBid->displayBidHTML();
}
else{
    echo "No auctions found";
}
*/
/*
$testCR = new ContractReader($conn);
print_r($testCR->getContractByContractPK(33));
$testContract = $testCR->getContractByContractPK(33);
echo "<br/><br/>";
echo $testContract->displayContractHTML();
//echo "<br/>";
//print_r($testCR->getContractByContractPK(34));
echo "<br/> ----- ";

$sql = "SELECT * FROM `auction_system`.`Contract` WHERE `contractPK` = 37";
$result=mysqli_query($conn, $sql);
$currentContract = null;
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<br/> ----- ";
    print_r($row);
    echo "<br/> ----- ";
    $currentContract = new Contract($row);
    echo $currentContract->displayContractHTML();
}
else{
    echo "error";
}

echo "<br/> ----- ";

$test2contract = new Contract(99, "what a great world", 6, 4, 7, 100, 1560578050,0,0,0,0);
echo $test2contract->displayContractHTML();
*/
/*
$testAR = new AuctionReader($conn);
print_r($testAR->getAuctionByAuctionPK(16));
$testAuction = $testAR->getAuctionByAuctionPK(16);
echo "<br/>";
echo $testAuction->displayAuctionHTML();
*/
/*
$ur = new UserReader($conn);
$testUser = $ur->getUserByUserPK(5);
$testUser->displayBasicUserHTML();
*/

//echo "hello";
//$br = new BidReader($conn);
//$testBid = $br->getBidByBidPK(55);
//print_r($testBid);

$bidPK = 70;
$bidOwnerFK = 5;

$br = new BidReader($conn);
if($br->checkIfBidOwner($bidPK,$bidOwnerFK)){
    echo "User $bidOwnerFK is the owner of bid $bidPK";
}
else{
    echo "User $bidOwnerFK is NOT the owner of bid $bidPK";
}



