<?php

    // includes out connect.php script
    require_once("connect.php");

    session_start();

    // define empty variables
    $username = $email = $password = $confirm_password = $error_msg = "";

    // validate data by removing unnecessary characters
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $confirm_password = test_input($_POST["confirm_password"]);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    /** LOGIN FORM */
    // checks to see if the user clicked the login button
    if(isset($_POST['signup'])){
        // gets the form data for processing
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        /** LOGIN FOR STUDENT */
        if ($username != "" && $email != "" && $password != "" && $confirm_password != ""){
            if (preg_match("/^[a-zA-Z-' ]*$/", $username)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if($password === $confirm_password){
                        if(strlen($password) >= 5 ){
                            // selects and goes through all the students in the database
                            $select = "SELECT * FROM user WHERE email = '{$email}'";
                            // query the database to see if the email already exists
                            $query = mysqli_query($connection, $select);
                            if(mysqli_num_rows($query) == 0){
                                 // create and format some variable for the database
                                $date_created = date("Y/m/s h:i:sa"); // track the date the account was created
                                $last_login = 0; // track our users login
    
                                // insert the user into the database
                                $insert = "INSERT INTO user(username, email, password, last_login, date_created) VALUES ('{$username}','{$email}','{$password}','{$last_login}','{$date_created}')";
                                // query the database insert data into the database
                                $query1 = mysqli_query($connection, $insert);
                                $query2 = mysqli_query($connection, $select);
                                if(mysqli_num_rows($query2) == 1){
    
                                    /** USER CAN REGISTER */
    
                                    $success = true;
    
                                    // redirects user to the home page
                                    header("Location: login.php");
    
                                }
                                else
                                    $error_msg = "An error occurred and your account was not created :(";
                            }
                            else
                                $error_msg = "User with the email: ".$email." already exits";
                        }
                        else 
                            $error_msg = "Your password should be more than 5 characters long";
                    }   
                    else
                        $error_msg = "Passwords do not match!";
                }
                else
                    $error_msg = "Invalid email address!";
            }
            else
                $error_msg = "Username should only contain letters and white spaces";
        }
        else
            $error_msg = "Please fill out all the required fields!";
        
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
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
                <a href="../index.html"><img class="nav-logo" src="../images/ub-logo.png"
                        alt="University of Botswana logo"></a>
                <i class="fa-solid fa-bars-staggered nav-toggler"></i>
                <div class="nav-list-container">
                    <ul class="list nav-list collapsible-content">
                        <li><a href="#">News</a></li>
                        <li><a href="#">Research</a></li>
                        <li><a href="#">Experience</a></li>
                        <li><a href="#">Discover</a></li>
                        <li><a href="#">Study Here</a></li>
                        <li class="btn btn-primary btn-nav"><a href="./login.html">Login</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section class="form container">
        <div>
            <div class="form_header">
                <h3 class="form_title">Ready to start your success?</h3>
                <p class="form_description">Signup to our website to start your journey at the University of Botswana</p>
            </div>
            <?php 
                // checks to see if the error message is set, if so display if
                if (isset($error_msg))
                    echo "<p class='errors'>".$error_msg."</p>";
                else
                    echo ""; // do nothing
            ?>
            <form class="form_box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="form_group">
                    <label for="username">Username</label><br>
                    <input type="text" name="username" id="username" value="<?php echo $username;?>">
                </div>
                <div class="form_group">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" value="<?php echo $email;?>">
                </div>
                <div class="form_group">
                    <label>Password</label><br>
                    <input type="password" name="password">
                </div>
                <div class="form_group">
                    <label>Confirm Password</label><br>
                    <input type="password" name="confirm_password">
                </div>
                <div class="checkbox">
                    <div>
                        <input type="checkbox" id="terms" name="terms" value="Terms and Conditions">
                        <label for="terms">By Signing up you agree to our <a href="#">Terms and Conditions</a></label>
                    </div>
                </div>
                <input class="btn btn-primary" type="submit" name="signup" value="Sign Up">
            </form>
            <p class="login">Already have an account? <a class="login_btn" href="./login.php">Login</a></p>
        </div>
        <div class="form_banner">
            <img src="../images/Signup.svg" alt="" srcset="">
        </div>
    </section>
    <script src="../JS/main.js"></script>
</body>

</html>