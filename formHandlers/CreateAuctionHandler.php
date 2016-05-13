<?php
session_start();
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 3/5/16
 * Time: 3:08 PM
 */
include '../classes/Auction.php';
include '../classes/AuctionWriter.php';
include '../classes/dbConnect.php';
/*
print_r($_POST);
echo "<br/>";
print_r($_SESSION);
echo "<br/>";
*/
//Create AuctionWriter object
$aw = new AuctionWriter($_SESSION['userPK'], $_POST['maxBidAmt'], $_POST['title'], $_POST['description'],
    $_POST['category'], $_POST['deadline'], $_POST['zipcode'], $_POST['auctionLength'], $_POST['photoRefLink']);

//Test out AuctionWriter toString
//echo $aw->__toString();

if($aw->__writeToDatabase($conn)) {
    header('Location: ../publicHTML/newAuctionDisplay.php');
    }
else{
    echo "Error in writing to database";
}
