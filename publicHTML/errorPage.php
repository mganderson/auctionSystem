<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" type="text/css" href="../style1.css">
</head>
<body>
<?php include '../publicHTML/navHeader.php';?>
<div class="form-container">

    <div class="form-title"><h2>Error</h2></div>
    <br/>
    <img class = ".img" src="../images/alert-128.png"/>
    <br/>
    <div class="form-title"><h2>
            <?php echo $_GET['errorMsg'];?>
        </h2></div>

</div>
</body>
</html>
<?php
include '../publicHTML/Footer.php';