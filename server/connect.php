<?php

function connect(){
    $servername = "localhost";
   $username = "deb38057_fpl";
       $password = "gretel";
    $dbname = "deb38057_fpl";

   // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


?>