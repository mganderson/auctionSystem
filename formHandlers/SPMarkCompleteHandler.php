<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header('Location: ../publicHTML/login.php');
}
if (!isset($_SESSION['contractPK'])) {
    header('Location: ../publicHTML/errorPage.php');
}

include "../classes/Auction.php";
include "../classes/Bid.php";
include "../classes/Functions.php";
include "../classes/dbConnect.php";
include "../classes/Contract.php";
include "../classes/ContractReader.php";
include "../classes/ContractWriter.php";
include "../classes/AuctionReader.php";

$cw = new ContractWriter($conn);
if($cw->updateStatusPerSP($_SESSION['contractPK'], 1)){
    header('Location: ../publicHTML/spJobControlPanel.php?contractPK=' . $_SESSION['contractPK']);
}
else{
    $errorMsg = "Unable to query database";
    header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
}