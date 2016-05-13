<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header('Location: ../publicHTML/login.php');
}

include "../classes/Auction.php";
include "../classes/dbConnect.php";
include '../publicHTML/navHeader.php';


echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>New Auction Created Successfully</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';

$userPK = $_SESSION["userPK"];
//echo "$userPK <br/>";
$sql = "SELECT * FROM auction_system.Auction WHERE auctionOwnerFK = $userPK ORDER BY dateCreated DESC";
//echo "$sql <br/>";
$result=mysqli_query($conn, $sql);
if($result->num_rows > 0) {
    echo "<h2>Auction Created Successfully!</h2>";
    $row = $result->fetch_assoc();
    //print_r($row);
    $currentAuction = new Auction($row);
    echo $currentAuction->displayAuctionHTML();
}
else{
    echo "No auctions found";
}
echo    '
        </div>
        ';
include '../publicHTML/Footer.php';



/*
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<div class="info-container">

    <?php
    $userPK = $_SESSION["userPK"];
    $sql = "SELECT * FROM auction_system.Auction WHERE auctionOwnerFK = \"$userPK\"";
    $result=mysqli_query($this->conn, $sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentAuction = new Auction($row);
        echo $currentAuction->__toString();
    }
    else{
        echo "No auctions found";
    }

    //echo "test";
    ?>

</div>
</body>
</html>
*/