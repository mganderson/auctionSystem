<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<form class="form-container" action ="../formHandlers/loginHandler.php" method="POST">

    <div class="form-title"><h2>Login</h2></div>

    <div class="form-title">Username (Email address)</div>
    <input class="form-field" type="text" name="email" /><br />

    <div class="form-title">Password</div>
    <input class="form-field" type="password" name="password" required/><br />

    <div class="submit-container">
        <input class="submit-button" type="submit" value="Submit" />
    </div>
</form>
</body>
</html>
<?php
include '../publicHTML/Footer.php';