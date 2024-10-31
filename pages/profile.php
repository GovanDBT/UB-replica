<?php 
    // includes out connect.php script
    require_once("connect.php");

    session_start();
    // checks to see if the user is already logged in, if so redirect them to the home page
    if(isset($_SESSION['userID'])){
        $LOGGED_IN = true;
    }
    else
        $LOGGED_IN = false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Botswana</title>
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
                <a href="index.html"><img class="nav-logo" src="../images/ub-logo.png" alt="University of Botswana logo"></a>
                <i class="fa-solid fa-bars-staggered nav-toggler"></i>
                <div class="nav-list-container">
                    <ul class="list nav-list collapsible-content">
                        <li><a href="#">News</a></li>
                        <li><a href="#">Research</a></li>
                        <li><a href="#">Experience</a></li>
                        <li><a href="#">Discover</a></li>
                        <li><a href="./application_form.php">Study Here</a></li>
                        <li class="btn btn-primary btn-nav">
                            <?php
                                // display the user aware navigation links
                                if($LOGGED_IN == true){
                                    //get the users account information from the database
                                    $select = "SELECT * FROM user WHERE user_id = '{$_SESSION['userID']}'";
                                    $query = mysqli_query($connection, $select);
                                    if(mysqli_num_rows($query) == 1){
                                        $_USER = mysqli_fetch_assoc($query);
                                        echo '<a class="Username">'.$_USER['username'].'</a>';
                                    }
                                    else{
                                        echo "Unable to load your account information";
                                    }
                                }
                                else{
                                    echo "<a href='./pages/login.php'>login</a>";
                                }
                            
                            ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <a href="./logout.php" class="btn btn-primary">Logout</a>
    <script src="../JS/main.js"></script>
</body>
</html>