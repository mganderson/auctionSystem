<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/4/16
 * Time: 9:42 PM
 */

class logInModule{
    /**
     * logInModule constructor.
     */
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function __logIn($email, $password){
        $sql = "SELECT * FROM auction_system.User WHERE email = \"$email\"";
        $result=mysqli_query($this->conn, $sql);
        if($result->num_rows == 1){
            //echo "Valid email!<br/>";
            $row = $result->fetch_assoc();
            //echo "$row[email] <br/>";
            //echo "$row[hashedPassword] <br/>";
            if($row[hashedPassword] == md5($password)){
                //echo "Success!<br/>";
                //Initialize session
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
                $_SESSION['login_user']= $row['userPK'];
                //print_r($_SESSION);
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }


}
