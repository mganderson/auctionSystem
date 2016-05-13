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
include "../classes/Contract.php";
include "../classes/ContractReader.php";
include "../classes/AuctionReader.php";
include "../classes/UserReader.php";
include "../classes/UserAlt.php";


echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Job Control Panel</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';

//set UserID as variable
$userPK = $_SESSION["userPK"];

//Instantiate new ContractReader
$cr = new ContractReader($conn);

//Instantiate new AuctionReader
$ar = new AuctionReader($conn);

//Instantiate new UserReader;
$ur = new UserReader($conn);

//Get contract PK from GET and put in a variable
$currentContractPK = $_GET['contractPK'];

//Get contract PK from GET and save as a session variable for script later
$_SESSION['contractPK'] = $_GET['contractPK'];

//Instantiate contract object
$currentContract = $cr->getContractByContractPK($currentContractPK);

//Instantiate auction object
$currentAuction = $ar->getAuctionByAuctionPK($currentContract->getAuctionFK());

echo "<h2>Service Provider Control Panel</h2>";


if($userPK == $currentContract->getServiceProviderFK()){
    //Display job info
    echo $currentContract->displayContractHTML();
    echo "<br/>";

    //display Mark as Completed button
    echo "
      <br/>
      <div style=\"text-align:center;\">
      <a href=\"/AuctionSystem/formHandlers/SPMarkCompleteHandler.php\" class=\"myButton\">Mark As Completed</a>
      </div>
      <br/>
      ";

    //if current contract is not disputed by the consumer
    if($currentContract->getDisputedBySP() == 0){
        //display Flag as Disputed button
        echo "
              <br/>
              <div style=\"text-align:center;\">
              <a href=\"/AuctionSystem/formHandlers/SPMarkDisputedHandler.php\" class=\"redButton\">Flag as disputed</a>
              </div>
              <br/>
              ";
    }
    //Else display Unflag as disputed
    else{
        //TODO redirect to actual script
        echo "
              <br/>
              <div style=\"text-align:center;\">
              <a href=\"/AuctionSystem/formHandlers/SPUnmarkDisputedHandler.php\" class=\"myButton\">Un-flag as disputed</a>
              </div>
              <br/>
              ";
    }


    echo "<b>Consumer contact: </b></br>";
    //Instantiate User object for consumer and display user contact info
    echo $ur->getUserByUserPK($currentContract->getConsumerFK())->displayBasicUserHTML();
    echo "<br/>";

    echo "<b>Service Provider contact: </b></br>";
    //Instantiate User object for consumer and display user contact info
    echo $ur->getUserByUserPK($currentContract->getServiceProviderFK())->displayBasicUserHTML();
    echo "<br/>";

    echo $currentAuction->displayAuctionHTMLasContractdetails();
}
else{
    echo "
          <div class=\"form-title\"><h2>Something went wrong...</h2></div>
          <br/>
          <img class = \".img\" src=\"../images/question-128.png\"/>
          <br/>
          <div class=\"form-title\"><h2>
          UserID does not match ServiceProviderFK
          </h2></div>
         ";
}

echo    '
        </div>
        ';
include '../publicHTML/Footer.php';
