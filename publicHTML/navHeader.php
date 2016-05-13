<?php
session_start();

if (isset($_SESSION['login_user'])){
    echo '
    <div class="nav-container">
    <div class="form-title"><h2>ONLINE AUCTION SYSTEM</h2></div>

    <!-- start of dropdown div and icon -->
    <div class="dropdown">
    <img src="../images/menuicon.svg">
        <!--dropdown content-->
        <div class="dropdown-content">
        <div class="form-title"><a href="home.php">Home</a></div>
        <div class="form-title"><a href="searchAuctions.php">Search Auctions</a></div>
        <div class="form-title"><a href="createAuctionForm.php">Create New Auction</a></div>
        <div class="form-title"><a href="userAuctions.php">My Auctions</a></div>
        <div class="form-title"><a href="userBids.php">My Bids</a></div>
        <div class="form-title"><a href="userJobs.php">My Jobs</a></div>
        <div class="form-title"><a href="../formHandlers/logout.php">Log Out</a></div>
        <!--End of dropdown content and dropdown div-->
        </div>
    <!--End of dropdown div-->
    </div>


    <div class="navIcon">
    <a href="home.php"><img src="../images/homeicon.svg"></a>
    </div>

    <div class="navIcon">
    <a href="searchAuctions.php"><img src="../images/search.svg"></a>
    </div>

    <div class="navIcon">
    <a href="createAuctionForm.php"><img src="../images/new.svg"></a>
    </div>

    <div class="navIcon">
    <a href="userAuctions.php"><img src="../images/auction.svg"></a>
    </div>

    <div class="navIcon">
    <a href="userBids.php"><img src="../images/bid.svg"></a>
    </div>

    <div class="navIcon">
    <a href="userJobs.php"><img src="../images/job.svg"></a>
    </div>

    <div class="navIcon">
    <a href="../formHandlers/logout.php"><img src="../images/logout.svg" height=""></a>
    </div>


    <!-- END TEST SECTION! -->

    </div>

    ';
} else{
    echo '
    <div class="nav-container">
    <div class="form-title"><h2>ONLINE AUCTION SYSTEM</h2></div>

    <!-- TEST SECTION! -->
    <div class="dropdown2">
    <img src="../images/menuicon.svg">
    <div class="dropdown-content">
    <div class="form-title"><a href="home.php">Home</a></div>
    <div class="form-title"><a href="createUserForm.php"> Create Account</a></div>
    <div class="form-title"><a href="searchAuctions.php">Search Auctions</a></div>
    <div class="form-title"><a href="login.php"> Login </a></div>
    </div>
    </div>

    <div class="navIcon">
    <a href="home.php"><img src="../images/homeicon.svg"></a>
    </div>

    <div class="navIcon">
    <a href="createUserForm.php"><img src="../images/newUser.svg"></a>
    </div>

    <div class="navIcon">
    <a href="searchAuctions.php"><img src="../images/search.svg"></a>
    </div>

    <div class="navIcon">
    <a href="login.php"><img src="../images/login.svg"></a>
    </div>

    <!-- END TEST SECTION! -->

    </div>
    ';
}
