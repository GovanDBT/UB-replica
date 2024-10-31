<?php

    // includes out connect.php script
    require_once("connect.php");

    session_start();

    /** LOGIN FORM */
    // checks to see if the user clicked the login button
    if(isset($_POST['login'])){
        // gets the form data for processing
        $status = $_POST['status'];
        $user = $_POST['name'];
        $password = $_POST['password'];

        /** LOGIN FOR STUDENT */
        if ($user != "" && $password != "" && $status == "student"){
            // selects and goes through all the organization names in the database
            $select = "SELECT * FROM Student_account WHERE student_Id = '{$user}'";
            // query the database to see if the name already exists
            $query = mysqli_query($connection, $select);
            if(mysqli_num_rows($query) == 1){
                // gets the records from the query
                $record = mysqli_fetch_assoc($query);

                // compares the passwords to make sure they match
                if($password === $record['password']){
                    // makes sure the user has activated their account
                    if($record['account_status'] == 1){
                        // update the last_login tracker
                        $last_login = time();
                        $update = "UPDATE Student_account SET last_login ='{$last_login}'";
                        $query = mysqli_query($connection, $update);

                        /** USER CAN LOGIN */

                        $_SESSION['stdId'] = $record['student_Id'];

                        $success = true;

                        // redirects user to the home page
                        header("Location: std.php");
                    }
                    else
                        $error_msg = "Please activate your account before you Login!";
                }
                else
                    $error_msg = "Your password is incorrect.";
            }
            else
                $error_msg = "Account does not exist! Try registering.";
        }
        else
            $error_msg = "Please fill out all the required fields!";

        /** LOGIN FOR ORGANIZATIONS */
        // makes sure the required fields are entered
        if ($user != "" && $password != "" && $status == "organisation"){
            // selects and goes through all the organization names in the database
            $select = "SELECT * FROM Org_account WHERE name = '{$user}'";
            // query the database to see if the name already exists
            $query = mysqli_query($connection, $select);
            if(mysqli_num_rows($query) == 1){
                // gets the records from the query
                $record = mysqli_fetch_assoc($query);

                // compares the passwords to make sure they match
                if($password === $record['password']){
                    // makes sure the user has activated their account
                    if($record['account_status'] == 1){
                        // update the last_login tracker
                        $last_login = time();
                        $update = "UPDATE Org_account SET last_login ='{$last_login}'";
                        $query = mysqli_query($connection, $update);

                        /** USER CAN LOGIN */

                        $_SESSION['name'] = $record['name'];

                        $success = true;

                        // redirects user to the home page
                        header("Location: org.php");
                    }
                    else
                        $error_msg = "Please activate your account before you Login!";
                }
                else
                    $error_msg = "Your password is incorrect.";
            }
            else
                $error_msg = "Account does not exist! Try registering.";
        }
        else
            $error_msg = "Please fill out all the required fields!";
        
        
    }

?>