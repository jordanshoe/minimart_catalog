<?php

    function connection(){
        $server_name = "localhost";
        $username    = "root";
        $password    = "root";  // For XAMPP users, password is "";
        $db_name     = "minimart_catalog";

        // create a connection
        $conn = new mysqli($server_name, $username, $password, $db_name);
        # $conn holds the connection to the db

        // check the connection / error handling
        if($conn->connect_error){
            // there is an error.
            die("Connection failed". $conn->connection_error);
        }else{
            // echo "yeeeesss succeessss";
            return $conn;
        }

        // -> object operator
        // connect error contains a string value of the error, It is blank if there is no error.
        // die() will terminate/stop the current program/script, and show a message.
        
    }

    // connection();


?>