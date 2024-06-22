<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job Vacancy</title>
    <link rel="stylesheet" href="Post_job_styles.css">
</head>
<body>
    <div class="container">
        <h2>Post a Job Vacancy</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" required><br><br>

            <label for="description">Job Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" required><br><br>

            <label for="location">Location:</label>
            <select id="location" name="location" required>
            <option value="Colombo">Colombo</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Matale">Matale</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Galle">Galle</option>
                        <option value="Matara">Matara</option>
                        <option value="Hambantota">Hambantota</option>
                        <option value="Jaffna">Jaffna</option>
                        <option value="Kilinochchi">Kilinochchi</option>
                        <option value="Mannar">Mannar</option>
                        <option value="Vavuniya">Vavuniya</option>
                        <option value="Mullaitivu">Mullaitivu</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Ampara">Ampara</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Polonnaruwa">Polonnaruwa</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Monaragala">Monaragala</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Kegalle">Kegalle</option>  
            </select><br><br>

            <label for="job_type">Job Type:</label>
            <select id="job_type" name="job_type" required>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Contract">Contract</option>
                <option value="Internship">Internship</option>
                <option value="Freelance">Freelance</option>
            </select><br><br>

            <label for="email">Contact Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="expire_date">Expire date:</label>
            <input type="date" id="expire_date" name="expire_date" required><br><br>

            <label for="company_logo">Company Logo:</label>
            <input type="file" id="company_logo" name="company_logo" accept="image/png, image/jpeg" required><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>

    <?php
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $jobTitle = $_POST["job_title"];
        $jobDescription = $_POST["description"];
        $jobCom = $_POST["company_name"];
        $jobLocation = $_POST["location"];
        $jobType = $_POST["job_type"];
        $jobEmail = $_POST["email"];
        $jobExpireDate = $_POST["expire_date"];
        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["company_logo"]["name"]);

            // Insert data into the database
            $sql = "INSERT INTO job_post (job_title, description, company_name, location, job_type, email, expire_date, company_image) 
                    VALUES ('$jobTitle', '$jobDescription', '$jobCom', '$jobLocation', '$jobType', '$jobEmail', '$jobExpireDate', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "Insert successful";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    ?>
</body>
</html>
