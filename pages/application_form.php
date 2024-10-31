<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
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
                        <li><a href="">Study Here</a></li>
                        <li class="btn btn-primary btn-nav"><a href="./login.php">Login</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section class="application_form container">
        <div>
            <div class="form_header">
                <h3 class="form_title">University of Botswana online application</h3>
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
                <!-- application details -->
                <fieldset>
                    <legend>Application Details:</legend>
                    <div class="form_group">
                        <label for="level">Level of Study</label><br>
                        <select id="level" name="level">
                            <option value="2025_24_sem01">Undergraduate</option>
                            <option value="2025_24_sem02">Graduate</option>
                            <option value="2025_24_sem01">International</option>
                            <option value="2025_24_sem01">Continuing Education</option>
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="career">Career of study</label><br>
                        <select id="career" name="career">
                            <option value="accountancy">Bachelor of Accountancy</option>
                            <option value="business">Bachelor of Business</option>
                            <option value="education_bio">Bachelor of Education(Biology)</option>
                            <option value="education_phy">Bachelor of Education(Physics)</option>
                            <option value="geomatics">Bachelor of  Geomatics</option>
                            <option value="arts">Bachelor of Arts</option>
                            <option value="science">Bachelor of Science</option>
                            <option value="computer_science">Bachelor of Computer Science</option>
                            <option value="mathematics">Bachelor in Mathematics</option>
                            <option value="chemistry">Bachelor in Chemistry</option>
                            <option value="economics">Bachelor of Economics</option>
                            <option value="finance">Bachelor of Finance</option>
                            <option value="real_estate">Bachelor in Real Estate</option>
                            <option value="counseling">Bachelor in Counseling</option>
                            <option value="design">Bachelor of Design</option>
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="term">Start Term</label><br>
                        <select id="term" name="term">
                            <option value="2025_24_sem01">2025/26 - Semester 1</option>
                            <option value="2025_24_sem02">2025/26 - Semester 2</option>
                            <option value="2025_24_sem01">2026/27 - Semester 1</option>
                            <option value="2025_24_sem01">2026/27 - Semester 2</option>
                            <option value="2025_24_sem01">2027/28 - Semester 1</option>
                            <option value="2025_24_sem01">2027/28 - Semester 2</option>
                        </select>
                    </div>
                </fieldset>
                <!-- student details -->
                 <fieldset>
                    <legend>Student Details:</legend>
                    <div class="form_group">
                        <label for="student_id">Student ID</label><br>
                        <input type="text" name="student_id" id="student_id">
                    </div>
                    <div class="form_group">
                        <label for="firstname">First Name</label><br>
                        <input type="text" name="firstname" id="firstname">
                    </div>
                    <div class="form_group">
                        <label for="middlename">Middle Name(s)</label><br>
                        <input type="text" name="middlename" id="middlename">
                    </div>
                    <div class="form_group">
                        <label for="lastname">Last Name</label><br>
                        <input type="text" name="lastname" id="lastname">
                    </div>
                    <div class="form_group">
                        <label for="DOB">Date of Birth</label><br>
                        <input type="date" name="DOB" id="DOB">
                    </div>
                    <div class="form_group">
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="form_group">
                        <label for="mobile_number">Mobile Number</label><br>
                        <input type="number" name="mobile_number" id="mobile_number">
                    </div>
                 </fieldset>
                <!-- documents -->
                 <fieldset>
                    <legend>Upload Documents</legend>
                    <div class="form_group">
                        <label for="id_name">ID Filename</label><br>
                        <input type="text" name="id_name" id="id_name"><br>
                        <label>Upload ID copy:</label><br>
                        <input type="file" name="id_file"><br><br>
                    </div>
                    <div class="form_group">
                        <label for="certificate_name">Certificate Filename</label><br>
                        <input type="text" name="certificate_name" id="certificate_name"><br>
                        <label>Upload Certificate:</label><br>
                        <input type="file" name="certificate_file"><br><br>
                    </div>
                 </fieldset>
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                <br>
            </form>
        </div>
    </section>

    <script src="../JS/main.js"></script>
</body>

</html>