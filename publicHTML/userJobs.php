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


echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>My Jobs</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';


//set UserID as variable
$userPK = $_SESSION["userPK"];

//Instantiate new Contract Reader
$cr = new ContractReader($conn);

//Get contract display choice from GET
$displayChoice = $_GET['displayChoice'];

echo "<h2>Display jobs where I'm the...</h2><br/>";

//display buttons as to whether consumer or service provider contracts should be displayed
//button for Consumer
echo "
      <div style=\"text-align:center;\">
      <a href=\"userJobs.php?displayChoice=consumer\" class=\"myButton\">Consumer</a>
      </div>
      <br/>
      ";

echo "<br/>";

//button for Service Provider
echo "
      <div style=\"text-align:center;\">
      <a href=\"userJobs.php?displayChoice=sp\" class=\"myButton\">Service Provider</a>
      </div>
      <br/>
      ";

echo "<br/>";

//if consumer contracts are to be displayed
if($displayChoice == "consumer"){
    //Print information header
    echo "<hr class='style1'/>";
    echo '
    <h2>MY JOBS
    <br/><i>Where I\'m the consumer</i></h2>
    ';

    //Get and display jobs where user is the consumer
    $userConsumerContracts = $cr->getContractsByOwnerPK($userPK);
    if(!empty($userConsumerContracts)) {
        foreach ($userConsumerContracts as $contract) {
            echo $contract->displayContractHTML();
            echo "</br>";
            //display button for control panel
            echo "
                 <br/>
                 <div style=\"text-align:center;\">
                 <a href=\"consumerJobControlPanel.php?contractPK=" . $contract->getContractPK() . "\" class=\"myButton\">Job Control Panel</a>
                 </div>
                 <br/>
                 ";

            echo "<hr class='style1'/>";
        }
    }
    else{
        echo "No contracts found where you're the consumer (Your user ID: " . $userPK . ")";
    }
}

//if service provider contracts are to be displayed
elseif($displayChoice == "sp"){
    //Print information header
    echo "<hr class='style1'/>";
    echo '
     <h2>MY JOBS
     <br/><i>Where I\'m the service provider</i></h2>
     ';
//Get and display jobs where user is the consumer
    $userSPContracts = $cr->getContractsByServiceProviderPK($userPK);
    if(!empty($userSPContracts)) {
        foreach ($userSPContracts as $contract) {
            echo $contract->displayContractHTML();
            echo "</br>";
            //display button for control panel
            echo "
                 <br/>
                 <div style=\"text-align:center;\">
                 <a href=\"spJobControlPanel.php?contractPK=" . $contract->getContractPK() . "\" class=\"myButton\">Job Control Panel</a>
                 </div>
                 <br/>
                 ";

            echo "<hr class='style1'/>";
        }
    }
    else{
        echo "No contracts found where you're the service provider (Your user ID: " . $userPK . ")";
    }
}

echo    '
        </div>
        ';
include '../publicHTML/Footer.php';
