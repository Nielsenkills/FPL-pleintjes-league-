<?php

function connect(){
    $servername = "localhost";
   $username = "rverhu_fpl";
       $password = "g84re9g84";
    $dbname = "rverhu_fpl";

   // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


?>