<?php

    // includes out connect.php script
    require_once("connect.php");

    session_start();

    // define empty variables
    $email = $password = $error_msg = "";

    // validate data by removing unnecessary characters
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    /** LOGIN FORM */
    // checks to see if the user clicked the login button
    if(isset($_POST['login'])){
        // gets the form data for processing
        $email = $_POST['email'];
        $password = $_POST['password'];
        $student = "SELECT * FROM user WHERE status = 'student'";
        $admin = "SELECT * FROM user WHERE status = 'admin'";

        /** LOGIN FOR STUDENT */
        if ($email != "" && $password != "" && $student){
            // selects and goes through all the students in the database
            $select = "SELECT * FROM user WHERE email = '{$email}'";
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
                        $last_login = date("Y/m/s h:i:sa");
                        $update = "UPDATE user SET last_login ='{$last_login}'";
                        $query = mysqli_query($connection, $update);

                        /** USER CAN LOGIN */

                        $_SESSION['userID'] = $record['user_id'];

                        $success = true;

                        // redirects user to the home page
                        header("Location: ../index.php");
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
        // if ($user != "" && $password != "" && $status == "organisation"){
        //     // selects and goes through all the organization names in the database
        //     $select = "SELECT * FROM Org_account WHERE name = '{$user}'";
        //     // query the database to see if the name already exists
        //     $query = mysqli_query($connection, $select);
        //     if(mysqli_num_rows($query) == 1){
        //         // gets the records from the query
        //         $record = mysqli_fetch_assoc($query);

        //         // compares the passwords to make sure they match
        //         if($password === $record['password']){
        //             // makes sure the user has activated their account
        //             if($record['account_status'] == 1){
        //                 // update the last_login tracker
        //                 $last_login = time();
        //                 $update = "UPDATE Org_account SET last_login ='{$last_login}'";
        //                 $query = mysqli_query($connection, $update);

        //                 /** USER CAN LOGIN */

        //                 $_SESSION['name'] = $record['name'];

        //                 $success = true;

        //                 // redirects user to the home page
        //                 header("Location: org.php");
        //             }
        //             else
        //                 $error_msg = "Please activate your account before you Login!";
        //         }
        //         else
        //             $error_msg = "Your password is incorrect.";
        //     }
        //     else
        //         $error_msg = "Account does not exist! Try registering.";
        // }
        // else
        //     $error_msg = "Please fill out all the required fields!";
        
        
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Poppins:wght@300;400;700;800&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/6f879d6c21.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="navigation-menu">
            <nav class="nav nav-hero collapsible container">
                <a href="../index.php"><img class="nav-logo" src="../images/ub-logo.png"
                        alt="University of Botswana logo"></a>
                <i class="fa-solid fa-bars-staggered nav-toggler"></i>
                <div class="nav-list-container">
                    <ul class="list nav-list ">
                        <li class="collapsible-content"><a href="#">News</a></li>
                        <li><a href="#">Research</a></li>
                        <li><a href="#">Experience</a></li>
                        <li><a href="#">Discover</a></li>
                        <li><a href="#">Study Here</a></li>
                        <li class="btn btn-primary btn-nav"><a href="#">Login</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section class="form container">
        <div>
            <div class="form_header">
                <h3 class="form_title">Welcome back</h3>
                <p class="form_description">Login back to access your UB account, please do not share your credentials with others</p>
                <?php 
                    // checks to see if the error message is set, if so display if
                    if (isset($error_msg))
                        echo "<p class='errors'>".$error_msg."</p>";
                    else
                        echo ""; // do nothing
                ?>
            </div>
            <form class="form_box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="form_group">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" value="<?php echo $email;?>">
                </div>
                <div class="form_group">
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password">
                </div>
                <div class="checkbox">
                    <div class="remember_me">
                        <input type="checkbox" id="show_pass" name="show_pass" onclick="showPassword()">
                        <label for="show_pass">show Password</label>
                    </div>
                </div>
                <div class="checkbox">
                    <div class="remember_me">
                        <input type="checkbox" id="terms" name="terms" value="Terms and Conditions">
                        <label for="terms">Remember me</label>
                    </div>
                    <a href="#">Forgot Password</a>
                </div>
                <input class="btn btn-primary" type="submit" name="login" value="Login">
            </form>
            <p class="login">Don't have an account? <a class="login_btn" href="./signup.php">Signup</a></p>
        </div>
        <div class="form_banner">
            <img src="../images/Signup.svg" alt="" srcset="">
        </div>
    </section>
    <script src="../JS/main.js"></script>
    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>