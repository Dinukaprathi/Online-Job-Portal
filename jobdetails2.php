<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Details</title>
    <link rel="stylesheet" href="jobdetails2.css">
</head>
<body>
<?php
session_start();
include 'connection.php';

// Function to check if the user is logged in as a job seeker
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'jobseeker';
}

// Retrieve job ID from URL parameter
if(isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    
    // Fetch job details based on job ID from the database
    $sql = "SELECT * FROM job_post WHERE job_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Display job details
        while ($row = $result->fetch_assoc()) {
            
            echo "<div class='job_details'>";
            echo "<div class='company_logo'>";
            echo "<img src='" . $row['company_image'] . "' alt='Company Logo'>";
            echo "<h2>" . $row["job_title"] . "</h2>";
            echo "<p><strong>Company Name:</strong> " . $row["company_name"] . "</p>";
            echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
            echo "<p><strong>Job Type:</strong> " . $row["job_type"] . "</p>";
            echo "<p><strong>Apply on this email:</strong> " . $row["email"] . "</p>";
            echo "<p><strong>Expire on:</strong> " . $row["expire_date"] . "</p>";
            echo "<p><strong>Job Description:</strong><br>" . $row["description"] . "</p>";
            
            // Check if user is logged in as a job seeker
            if(isLoggedIn()) {
                echo "<a href='upload_cv.php?job_id=" . $job_id . "'><button>Upload CV</button></a>";
            } else {
                echo "<p>Please <a href='login.php'>log in</a> or <a href='Registration.php'>register</a> to apply for this job.</p>";
            }
            
            echo "</div>";
        }
    } else {
        echo "No job details found for the provided job ID";
    }
} else {
    echo "Job ID not provided";
}
?>
