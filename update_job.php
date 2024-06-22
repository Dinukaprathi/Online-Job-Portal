<?php
include 'connection.php';

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Retrieve record from database
    $sql = "SELECT * FROM job_post WHERE job_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $job_title = $row['job_title'];
        $description = $row['description'];
        $company_name = $row['company_name'];
        $location = $row['location'];
        $job_type = $row['job_type'];
        $email = $row['email'];
        $expire_date = $row['expire_date'];
        
        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Get updated data
            $new_job_title = $_POST['job_title'];
            $new_description = $_POST['description'];
            $new_company_name = $_POST['company_name'];
            $new_location = $_POST['location'];
            $new_job_type = $_POST['job_type'];
            $new_email = $_POST['email'];
            $new_expire_date = $_POST['expire_date'];
            
            // Update record in database
            $update_sql = "UPDATE job_post SET job_title = ?, description = ?, company_name = ?, location = ?, job_type = ?, email = ?, expire_date = ? WHERE job_ID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("sssssssi", $new_job_title, $new_description, $new_company_name, $new_location, $new_job_type, $new_email, $new_expire_date, $id);
            
            if($update_stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $update_stmt->error;
            }
        }
    } else {
        echo "Record not found";
        exit();
    }
} else {
    echo "ID parameter is missing";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Job Post</title>
</head>
<body>
    <h2>Update Job Post</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
        <label for="job_title">Job Title:</label><br>
        <input type="text" id="job_title" name="job_title" placeholder="job Title" ><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" placeholder="Description"></textarea><br>
        <label for="company_name">Company Name:</label><br>
        <input type="text" id="company_name" name="company_name" placeholder="Company name"><br>
        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" placeholder="location"><br>
        <label for="job_type">Job Type:</label><br>
        <input type="text" id="job_type" name="job_type" placeholder="Job Type"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Email"><br>
        <label for="expire_date">Expire Date:</label><br>
        <input type="date" id="expire_date" name="expire_date" placeholder="Expire date" required><br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>

