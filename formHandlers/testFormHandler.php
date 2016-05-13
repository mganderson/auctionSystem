<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 3/6/16
 * Time: 1:19 PM
 */

include '../classes/dbConnect.php';
/*
$sql = "  INSERT INTO auction_system.test (name, email)
          VALUES ('" . $_POST["name"] . "', '" . $_POST["email"] . "')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

*/

// prepare and bind statement
$stmt = $conn->prepare("INSERT INTO auction_system.test (name, email) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $email);

// set parameters and execute
$name = $_POST["name"];
$email = $_POST["email"];

if($stmt->execute()){
    echo "New records created successfully";
}
else{
    echo "Error";
}

$stmt->close();
$conn->close();
