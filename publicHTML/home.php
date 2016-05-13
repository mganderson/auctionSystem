<?php
session_start();

include '../publicHTML/navHeader.php';


echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../style1.css">
        </head>
        <body>
        <div class="info-container">
        ';


if (isset($_SESSION['login_user'])) {

    echo '
        <div class="form-title" ><h2> Welcome! </h2 ></div >
        <img src = "../images/happypeople.svg" height="128px" width="128px" >
        </br >
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet libero pellentesque, lobortis enim eget, malesuada nulla.
        </br></br>
        Mauris sapien ipsum, tincidunt eu imperdiet scelerisque, suscipit non tortor. Vestibulum congue sapien id luctus malesuada. Sed eu auctor nibh.
        </br></br>
        <div class="form-title" ><h2 > <a href="createAuctionForm.php">Why not create a new auction!</a> </h2 ></div >
        ';
}
else{
    echo '
        <div class="form-title" ><h2 > Welcome! </h2 ></div >
        <img src = "../images/happypeople.svg" height="128px" width="128px" >
        </br >
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet libero pellentesque, lobortis enim eget, malesuada nulla.
        </br></br>
        Mauris sapien ipsum, tincidunt eu imperdiet scelerisque, suscipit non tortor. Vestibulum congue sapien id luctus malesuada. Sed eu auctor nibh.
        </br></br>
        <div class="form-title" ><h2 > <a href="login.php">Click here to log in!</a> </h2 ></div >
        ';
}
echo '
    </div>
    </body>
    </html>
     ';


include '../publicHTML/Footer.php';
