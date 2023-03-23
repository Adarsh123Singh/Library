<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_details";

$con = mysqli_connect($servername,$username,$password,$dbname);

    if($con){
        // echo "Successfully Connected";
    }
    else{
        echo "Connection failed" . mysqli_connect_error();
    }
?>