<?php
session_start();
include 'connection.php';

// Check if the user is logged in as a job seeker
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'jobseeker') {
    // If not logged in or not a job seeker, redirect to login page
    header("Location: login.php");
    exit();
}

// Fetch job seeker's name from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT Fname FROM registration WHERE reg_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row['Fname'];
} else {
    // If job seeker details not found, redirect to login page
    header("Location: login.php");
    exit();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Seeker Dashboard</title>
    <link rel="stylesheet" href="job_seeker_dashboard_styles.css">
</head>
<body>
    <div class="navbar">
        <a href="Show_applied_jobs.php">Show Applied Jobs</a>
        <a href="job_seeker_dashborad.php">Apply for Jobs</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>Welcome, <?php echo $fname; ?>!</h1>
        <h2>Job Seeker Dashboard</h2>
        <!-- Include job details or other content here -->
        <?php include 'displayjob_withuploadcv.php'; ?>
       
    </div>
</body>
</html>
