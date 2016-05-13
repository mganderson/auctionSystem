<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 3/4/16
 * Time: 8:08 PM
 */

include '../classes/User.php';
include '../classes/UserWriter.php';
include '../classes/dbConnect.php';
include '../classes/LogInModule.php';
include '../classes/UserReader.php';
include '../classes/userAlt.php';


/*
print_r($_POST);
print "<br/>";
*/

//print_r($_POST);

//instantiating new UserWriter
$uw = new UserWriter($_POST["firstName"], $_POST["lastName"], $_POST["address1"], $_POST["address2"],
    $_POST["city"], $_POST["state"], $_POST["zip"], $_POST["email"], $_POST["password"]);

//instantiate new UserReader
$ur = new UserReader($conn);

//check to see if an account already exists under the email address
if($ur->seeIfAccountExistsForEmail($_POST["email"])){
    $errorMsg = "Error - Account already exists under email " . $_POST["email"];
    header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
}
else{
    if($uw->__writeToDatabase($conn)){
        //echo "wrote user to database successfully";
        $lim = new logInModule($conn);
        if($lim->__logIn($_POST["email"], $_POST["password"])){
            header('Location: ../publicHTML/newUserSuccess.php');
        }
        else{
            $errorMsg = "Error - Could not log in new user";
            header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
        }

    }
    else{
        $errorMsg = "Error - Could not write new user to database";
        header('Location: ../publicHTML/errorPage.php?errorMsg=' . urlencode($errorMsg));
    }
}

//print_r($uw);



/*
//Test out new record
$newAccountEmail = $uw->getEmail();
$sql="SELECT * FROM auction_system.User WHERE email = \"$newAccountEmail\"";
$result=mysqli_query($conn, $sql);
print_r($result);
print("<br/>");

// Create numeric array
print("<br/>Numeric Array<br/>");
$row = mysqli_fetch_array($result, MYSQLI_NUM);
print_r($row);

echo "<br/> <br/>";
//Instantiate User object and call toString
$testUser = new User($row);
echo $testUser->__toString();
*/
//Prepared statement for creating record in auction_system.User
// prepare and bind statement
/*
$stmt = $conn->prepare("INSERT INTO auction_system.User (firstName,lastName, address1, address2, city,
    state, zip, email, rating, suspended, hashedPassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssiis", $firstName, $lastName, $address1, $address2, $city, $state, $zip, $email, $rating,
    $suspended, $hashedPassword);

// set parameters and execute
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$email = $_POST["email"];
$rating = null;
$suspended = 0;
$hashedPassword = md5($_POST["password"]);


$sql = "SELECT * FROM auction_system.User WHERE email = \"$email\"";
$result=mysqli_query($conn, $sql);
if($result->num_rows > 0){
    echo "Account already exists for this email address";
}
else{
    if($stmt->execute()){
        echo "New user record created successfully </br><br/>";

        //Test out new record
        $sql="SELECT * FROM auction_system.User WHERE email = \"$email\"";
        $result=mysqli_query($conn, $sql);
        print_r($result);
        print("<br/>");

        // Create numeric array
        print("<br/>Numeric Array<br/>");
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        print_r($row);

        echo "<br/> <br/>";
        //Instantiate User object and call toString
        $testUser = new User($row);
        echo $testUser->__toString();

    }
    else {
        echo "Error";
    }
}

*/





$stmt->close();
$conn->close();
