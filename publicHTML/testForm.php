<!DOCTYPE html>
<html lang="en">
<head>
    <title>First HTML Form</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<form class="form-container" action ="../formHandlers/testFormHandler.php" method="POST">
    <div class="form-title"><h2>Create Account</h2></div>
    <div class="form-title">Name</div>
    <input class="form-field" type="text" name="name" /><br />
    <div class="form-title">Email</div>
    <input class="form-field" type="text" name="email" /><br />
    <div class="submit-container">
        <input class="submit-button" type="submit" value="Submit" />
    </div>

</form>
</body>
</html>

