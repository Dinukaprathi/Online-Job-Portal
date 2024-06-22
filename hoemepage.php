<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepageStyles.css">
    <title>Findjobs - Homepage</title>
</head>
<body>

    <div class="navbar">
        <div class="logo">
        <img src="/img/img1.png" alt="Logo" style="width: 70px; height: 70px;">
        </div>
        <div>
        
             <a href="help_&_support.php">Contact Us</a>
             <a href="login.php">Recruiter Login</a>
             <a href="login.php">User Login</a>
             <a href="#">All jobs</a>
             <a href="#Findjobs">FindJobs.lk</a>
        </div>
    </div>        

    <div class="image-container">
        <img src="src/images/img4.jpg" alt="Description of your image"> 
            <h1 id="h1_findcareer">Choose your career in right place!</h1>
             <h5 id="h5_tagline">Find Jobs, apply Online. Employers Post Jobs for free!</h5>
            
             <?php
            include 'search.html';
             ?><br>
       
    </div><br>
    <p id="featured_job">Featured Jobs</p>
    <hr id="linebreak"><br>

    <?php
    include 'Display_vacancy.php';
    ?><br><br> 
    <p id="jobs_by_category">Local and international companies work with us!</p>
    <hr id="linebreak"><br>

    <?php
   include 'companyimages.php';"<br>";
   require 'footer.php';
    ?>


</body>
</html>