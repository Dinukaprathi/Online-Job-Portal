<?php
session_start();
include 'connection.php';

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Get the user's ID
    $user_id = $_SESSION['user_id'];
    
    // Prepare and execute the SELECT query
    $sql = "SELECT COUNT(*) AS job_count FROM upload_cv WHERE reg_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if any rows were returned
    if($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        $job_count = $row['job_count'];
        
        echo "You have applied for " . $job_count . " jobs.";
    } else {
        echo "No applied jobs found for the logged-in user.";
    }
} else {
    echo "User not logged in.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Count</title>
</head>
<body>
    <h1>Job Count</h1>
    <p>Number of relevant jobs for you: <?php echo $job_count; ?></p>
</body>
</html>
