<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Auction</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
    <!-- data validation scripts-->
    <script type="text/javascript">
        //function to validate valid zip
        function validateZip() {
            var zip = document.getElementById("zipcode").value;
            var isValid = /^[0-9]{5}(?:-[0-9]{4})?$/.test(zip);
            if(!isValid && zip !='') {
                alert('Invalid zip code');
                document.getElementById("zipcode").value = '';
            }
        }
        //function to validate max bid
        function validateMaxBidAmt(){
            var maxBidAmt = document.getElementById("maxBidAmt").value;
            var regex = /^[0-9]*$/;
            var isValid = regex.test(maxBidAmt);
            if(!isValid && maxBidAmt!=''){
                alert('Invalid bid amount.  Bid must be a whole-dollar amount.');
                document.getElementById("maxBidAmt").value = '';
            }
        }


    </script>
    <!-- script to validate max bid-->
    <SCRIPT TYPE="text/javascript"> <!-- // copyright 1999 Idocs, Inc. http://www.idocs.com // Distribute this script freely but keep this notice in place function numbersonly(myfield, e, dec) { var key; var keychar; if (window.event) key = window.event.keyCode; else if (e) key = e.which; else return true; keychar = String.fromCharCode(key); // control keys if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) return true; // numbers else if ((("0123456789").indexOf(keychar) > -1)) return true; // decimal point jump else if (dec && (keychar == ".")) { myfield.form.elements[dec].focus(); return false; } else return false; } //--> </SCRIPT>

</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<form class="info-container" action ="../formHandlers/CreateAuctionHandler.php" method="POST">

    <div class="form-title"><h2>Create Auction</h2></div>

    <div class="form-title">Auction Title</div>
    <input class="form-field" type="text" name="title" maxlength="50" required/><br />

    <div class="form-title">Category</div>
    <select class="select-box" name="category" required>
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

    <div class="form-title">Job Description</div>
    <textarea class="text-area" type="text" name="description" required rows="5" cols="6"/></textarea><br />

    <div class="form-title">Maximum Price</div>
    <!--
    <input  class="form-field" type="number" name="maxBidAmt" min="1" step="1" value="0.00" required />
    -->
    <input  class="form-field" type="number" name="maxBidAmt" id="maxBidAmt" min="1" maxlength="10" required onKeyPress="return numbersonly(this, event)" onblur="validateMaxBidAmt()"/>

    <div class="form-title">Job Location Zipcode</div>
    <input class="form-field" type="text" name="zipcode" id="zipcode" maxlength="5" required onblur="validateZip()"/><br />

    <div class="form-title">Auction Length</div>
    <!-- <input class="form-field" type="text" name="auctionLength" required/><br /> -->
    <select class="select-box" name="auctionLength" required>
        <option value="43200">12 hours</option>
        <option value="86400">1 day</option>
        <option value="172800">2 days</option>
        <option value="259200">3 days</option>
        <option value="345600">4 days</option>
        <option value="432000">5 days</option>
        <option value="518400">6 days</option>
        <option value="604800">1 week</option>
    </select>

    <div class="form-title">Deadline for job completion</div>
    <!-- <input class="form-field" type="text" name="deadline" required/><br /> -->
    <select class="select-box" name="deadline" required>
        <option value="43200">12 hours after auction completion</option>
        <option value="86400">1 day after auction completion</option>
        <option value="172800">2 days after auction completion</option>
        <option value="259200">3 days after auction completion</option>
        <option value="345600">4 days after auction completion</option>
        <option value="432000">5 days after auction completion</option>
        <option value="518400">6 days after auction completion</option>
        <option value="604800">1 week after auction completion</option>
        <option value="1209600">2 weeks after auction completion</option>
        <option value="1814400">3 weeks after auction completion</option>
        <option value="1814400">3 weeks after auction completion</option>
        <option value="2419200">4 weeks after auction completion</option>
        <option value="99999999">No set deadline</option>
    </select>

    <div class="form-title">Photo URL</div>
    <input class="form-field" type="text" name="photoRefLink" /><br />

    <div class="submit-container">
        <input class="submit-button" type="submit" value="Submit" />
    </div>
</form>
</body>
</html>
<?php
include '../publicHTML/Footer.php';
