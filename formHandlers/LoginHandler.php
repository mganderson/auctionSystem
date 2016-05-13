<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 3/27/16
 * Time: 5:02 PM
 */

require '../classes/User.php';
include '../classes/LogInModule.php';
include '../classes/dbConnect.php';
/*
print_r($_POST);
print "<br/>";
*/
$lgm = new logInModule($conn);
if($lgm->__logIn($_POST["email"],$_POST["password"])){
    header('Location: ../publicHTML/loginSuccess.php');
}
else{
    $errorMsg = "Invalid email or password";
    header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
}

/*
$email = $_POST["email"];
$password = $_POST["password"];
//echo "<br/>";
//echo "Hash of submitted password: <br/>";
//echo md5($password);
//echo "<br/>";

// "select * from `user` where password='$password' AND email='$username'
$sql = "SELECT * FROM auction_system.User WHERE email = \"$email\"";
$result=mysqli_query($conn, $sql);
if($result->num_rows == 1){
    //echo "Valid email!<br/>";
    $row = $result->fetch_assoc();
    //echo "$row[email] <br/>";
    //echo "$row[hashedPassword] <br/>";
    if($row[hashedPassword] == md5($password)){
        //echo "Success!<br/>";
        session_start();
        $_SESSION['userPK'] = $row['userPK'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['address1'] = $row['address1'];
        $_SESSION['address2'] = $row['address2'];
        $_SESSION['city'] = $row['city'];
        $_SESSION['state'] = $row['state'];
        $_SESSION['zip'] = $row['zip'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['rating'] = $row['rating'];
        $_SESSION['suspended'] = $row['suspended'];
        $_SESSION['login_user']= $row['userPK']; //Initializes session
        //echo "Session variables: ";
        //print_r($_SESSION);
        //print_r($_SESSION);
        header('Location: ../publicHTML/loginSuccess.php');
    }
    else{
        echo "Invalid password";
    }
}
else{
    echo "Invalid email address";
}
*/