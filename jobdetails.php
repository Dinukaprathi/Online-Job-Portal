<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="jobsdetails_styles.css">
</head>
<body>

<?php
include 'connection.php';

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
            echo "<img src='" . $row['company_image'] . "' alt='Company Logo'>";
            echo "<h2>" . $row["job_title"] . "</h2>";
            echo "<p><strong>Company Name:</strong> " . $row["company_name"] . "</p>";
            echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";
            echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
            echo "<p><strong>Apply on Email:</strong> " . $row["email"] . "</p>";
            echo "<p><strong>Expire Date:</strong> " . $row["expire_date"] . "</p>";
            echo "<div class='company_logo'>";
            echo "<a href='login.php'><button>Apply Directly</button></a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No job details found for the provided job ID";
    }
} else {
    echo "Job ID not provided";
}
?>

</body>
</html>
