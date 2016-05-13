<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Auctions Near You</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<form class="info-container" action ="../publicHTML/auctionSearchResults.php" method="GET">

    <div class="form-title"><h2>Search Auctions</h2></div>

    <div class="form-title">Category</div>
    <select class="select-box" name="category" required>
        <option value="All">All</option>
        <option value="Creative">Creative</option>
        <option value="Event">Event</option>
        <option value="Computer-Tech">Computer-Tech</option>
        <option value="Writing">Writing</option>
        <option value="Domestic">Domestic</option>
        <option value="Landscaping">Landscaping</option>
        <option value="Handyperson">Handyperson</option>
        <option value="Odd Job">Odd Jobs</option>
        <option value="Other">Other</option>
    </select>

    <div class="form-title">Search Zipcode (optional)</div>
    <input class="form-field" type="text" name="zipcode"/><br />

    <!--
    <div class="form-title">Search Radius</div>
    <select class="select-box" name="radius" required>
        <option value=9999>Any radius</option>
        <option value=3>1 mile</option>
        <option value=5>3 miles</option>
        <option value=7>5 miles</option>
        <option value=12>10 miles</option>
        <option value=17>15 miles</option>
        <option value=27>25 miles</option>
        <option value=52>50 miles</option>
    </select>
    -->

    <div class="submit-container">
        <input class="submit-button" type="submit" value="Submit" />
    </div>
</form>
</body>
</html>

<?php
include '../publicHTML/Footer.php';