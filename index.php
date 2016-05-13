<?php header('Location: publicHTML/home.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<?php

if (isset($_SESSION['login_user'])){
    echo '
    <form class="nav-container">
    <div class="form-title"><h2>Navigation (Logged in)</h2></div>
    <div class="form-title">Log Out</div>
    <div class="form-title"><a href="publicHTML/home.php">Home</a></div>
    <div class="form-title"><a href="publicHTML/createUserForm.php">Create Account</a></div>
    <div class="form-title"><a href="publicHTML/createAuctionForm.php">Create Auction</a></div>
    <div class="form-title"><a href="publicHTML/createBidForm.php">Place Bid</a></div>
    <div class="form-title"><a href="publicHTML/searchAuctions.php">Search Auction</a></div>
    </form>
    ';
} else{
    echo '
    <div class="nav-container">
    <div class="form-title"><h2>Navigation (Logged out)</h2></div>
    <div class="form-title"><a href="publicHTML/home.php">Home</a></div>
    <div class="form-title"><a href="publicHTML/login.php"> Login </a></div>
    <div class="form-title"><a href="publicHTML/createUserForm.php"> Create Account</a></div>
    <div class="form-title"><a href="publicHTML/createAuctionForm.php">Create Auction</a></div>
    <div class="form-title"><a href="publicHTML/createBidForm.php">Place Bid</a></div>
    <div class="form-title"><a href="publicHTML/searchAuctions.php">Search Auction</a></div>
    </div>
    ';
} ?>
</body>
</html>