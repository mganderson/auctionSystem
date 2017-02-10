<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header('Location: ../publicHTML/login.php');
}

include "../classes/Auction.php";
include "../classes/Bid.php";
include '../classes/BidReader.php';
include "../classes/Functions.php";
include "../classes/dbConnect.php";
include '../classes/ContractReader.php';
include '../classes/Contract.php';
include '../publicHTML/navHeader.php';



echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>My Bids</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';

$userPK = $_SESSION["userPK"];
$sql = "SELECT * FROM auction_system.Bid WHERE bidOwnerFK = $userPK ORDER BY dateCreated DESC";
//echo "$sql <br/>";
$result=mysqli_query($conn, $sql);
$num_results = mysqli_num_rows($result);
if($result->num_rows > 0) {
    echo "<h2>My Bids:</h2>";
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        //$row = $result->fetch_assoc();
        echo"<i>Bid $i of $num_results:</i>";
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
        if($currentAuction->getActive() == 1){
            if($lowBidFK == $currentBid->getBidID()){
                echo "
                 <img class = \".img\" src=\"../images/happy-128.png\"/>
                 <br/>
                 <div class=\"form-title\"><h2>You're low bid!</h2></div>
                 ";
            }
            //If bid is not low bid
            else{

                //see if User is low bider with a different bid
                $br = new BidReader($conn);
                $lowBid = $currentAuction->getLowBid();
                //If yes
                if($br->checkIfBidOwner($lowBid,$userPK)){
                    echo "
                    <div class=\"form-title\"><h2>Your Bid $lowBid supersedes this bid</h2></div>
                    ";
                }
                //If no
                else{
                    //If not, prompt user to bid again
                    echo "
                    <img class = \".img\" src=\"../images/crying-128.png\"/>
                    <br/>
                    <div class=\"form-title\"><h2>You've been outbid!</h2></div>
                    ";
                    //Bid again button
                    echo "
                    <div style=\"text-align:center;\">
                    <a href=\"createBidForm.php?auctionPK=$currentAuctionID\" class=\"myButton\">Bid again!</a>
                    </div>
                    <br/>
                    ";
                }

            }

        }
        else{
            if($lowBidFK == $currentBid->getBidID()){
                echo "
                 <img class = \".img\" src=\"../images/happy-128.png\"/>
                 <br/>
                 <div class=\"form-title\"><h2>You won the auction!</h2></div>
                 ";
                //Go to My Jobs button
                echo "
                 <div style=\"text-align:center;\">
                 <a href=\"userJobs.php?displayChoice=sp\" class=\"myButton\">Go to My Jobs</a>
                 </div>
                 <br/>
                ";
            }
            else{
                echo "
                 <img class = \".img\" src=\"../images/crying-128.png\"/>
                 <br/>
                 <div class=\"form-title\"><h2>Someone else won the auction</h2></div>
                 ";
            }
        }





        $i+=1;
        echo "<hr class='style1'/>";
    }

}
else{
    echo "Sorry, it looks like you haven't placed any bids yet. (Your User ID: " . $userPK . ")";
}
echo    '
        </div>
        ';
include '../publicHTML/Footer.php';
