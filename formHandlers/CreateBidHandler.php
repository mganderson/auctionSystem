<?php
session_start();

include "../classes/BidReader.php";
include "../classes/Bid.php";
include "../classes/BidWriter.php";
include "../classes/dbConnect.php";
include "../classes/Auction.php";
include "../classes/Functions.php";

$auctionPK = $_SESSION['currentAuctionPK'];
$userPK = $_SESSION['userPK'];
$newBidAmt = $_POST['bidAmt'];
$sql = "SELECT * FROM auction_system.Auction
        WHERE auctionOwnerFK != $userPK
        AND auctionPK = '$auctionPK'
        ORDER BY dateCreated DESC";
$result=mysqli_query($conn, $sql);
$currentAuction = "";
$num_results = mysqli_num_rows($result);
if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $currentAuction = new Auction($row);
    }

    //TEST SECTION - Check if user is low bidder
    //instantiate BidReader
    //echo "\$userPK = " . $userPK;
    //echo "<br/> Low Bid ID = " . $currentAuction->getLowBid();
    $br = new BidReader($conn);
    //Check if there is a low bid
    if(!empty($currentAuction->getLowBid()) and $br->checkIfBidOwner($currentAuction->getLowBid(), $userPK)){
            $errorMsg = "Cannot place bid on Auction $auctionPK - You are already the low bidder";
            header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
    }
    else{
        $maxBid = $currentAuction->getMaxBidAmt();
        $lowBidAmt = getLowBidAmt($currentAuction,$conn);
        $currentTime = time();
        $auctionExpiry = $currentAuction->getDateCreated() + $currentAuction->getAuctionLength();
        if($currentTime < $auctionExpiry){
            //if($currentAuction->get)
            if($newBidAmt <= $maxBid){
                if($newBidAmt < $lowBidAmt or empty($lowBidAmt)){
                    if(!empty($newBidAmt)){
                        $bw = new BidWriter($auctionPK, $userPK, $newBidAmt);

                        $bidPK = $bw->writeToDatabase($conn);
                        header('Location: ../publicHTML/bidConfirmation.php?bidPK=' . $bidPK);
                    }
                    else{
                        $errorMsg = "Cannot place bid on Auction $auctionPK - Bid cannot be $0.";
                        header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
                    }

                }
                else{
                    $errorMsg = "Cannot place bid on Auction $auctionPK - Your bid must be lower than current low bid";
                    header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
                }
            }
            else{
                $errorMsg = "Cannot place bid on Auction $auctionPK - Your bid must be lower than the max bid";
                header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
            }
        }
        else{
            $errorMsg = "Cannot place bid on Auction $auctionPK - Auction has already expired";
            header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
        }
    }
}
else{
    $errorMsg = "Cannot place bid on Auction $auctionPK - Failed to connect to database";
    header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
}





//print_r($_POST);