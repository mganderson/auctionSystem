<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Account</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
    <!-- data validation scripts-->
    <script type="text/javascript">
        //function to validate email
        function validateEmail(){
            var email = document.getElementById("email").value;
            var regex = /.+@.+\..+/i;
            if(!regex.test(email)){
                alert ('Invalid email address');
                document.getElementById("email").value = '';
            }
        }

        //function to confirm emails match
        function confirmEmail() {
            var email = document.getElementById("email").value;
            var confemail = document.getElementById("confemail").value;
            if(email != confemail) {
                alert('Email address does not match.  Please confirm email address.');
                document.getElementById("confemail").value = '';
            }
        }
        //function to confirm passwords match
        function confirmPassword() {
            var email = document.getElementById("password").value;
            var confemail = document.getElementById("confpassword").value;
            if(email != confemail && confemail !='') {
                alert('Passwords do not match.  Please confirm password.');
                document.getElementById("confpassword").value = '';
            }
        }
        //function to validate valid zip
        function validateZip() {
            var zip = document.getElementById("zip").value;
            var isValid = /^[0-9]{5}(?:-[0-9]{4})?$/.test(zip);
            if(!isValid) {
                alert('Invalid zip code');
                document.getElementById("zip").value = '';
            }
        }
    </script>
</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<form class="form-container" action ="../formHandlers/CreateUserHandler.php" method="POST">

    <div class="form-title"><h2>Create Account</h2></div>

    <div class="form-title">Email (this is your user name)</div>
    <input class="form-field" type="text" maxlength="255" name="email" id="email" required onblur="validateEmail()"/><br />

    <div class="form-title">Confirm Email</div>
    <input class="form-field" type="text" maxlength="255" name="emailConfirm" id="confemail" required onblur="confirmEmail()"/>

    <div class="form-title">Password</div>
    <input class="form-field" type="password" maxlength="128" name="password" id="password" required/><br />

    <div class="form-title">Confirm Password</div>
    <input class="form-field" type="password" maxlength="128" name="passwordConfirm" id="confpassword" required onblur="confirmPassword()"/>

    <div class="form-title">First Name</div>
    <input class="form-field" type="text" name="firstName" maxlength="50" required/><br />

    <div class="form-title">Last Name</div>
    <input class="form-field" type="text" name="lastName" maxlength="50" required/><br />

    <div class="form-title">Address</div>
    <input class="form-field" type="text" maxlength="255" name="address1" required/><br />
    <input class="form-field" type="text" maxlength="255" name="address2" /><br />

    <div class="form-title">City</div>
    <input class="form-field" type="text" maxlength="50" name="city" required/><br />

    <div class="form-title">State</div>
    <select class="select-box" name="state" required>
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District Of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
        <option value="AS">American Samoa</option>
        <option value="GU">Guam</option>
        <option value="MP">Northern Mariana Islands</option>
        <option value="PR">Puerto Rico</option>
        <option value="UM">United States Minor Outlying Islands</option>
        <option value="VI">Virgin Islands</option>
    </select>

    <div class="form-title">Zipcode</div>
    <input class="form-field" type="text" name="zip" id="zip" maxlength="5" required onblur="validateZip()"/><br />


    <div class="submit-container">
        <input class="submit-button" type="submit" value="Submit" />
    </div>
</form>
</body>
</html>
<?php
include '../publicHTML/Footer.php';