<?php
include 'connection.php';

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Retrieve record from database
    $sql = "SELECT * FROM administration WHERE admin_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Get updated data
            $new_name = $_POST['name'];
            $new_address = $_POST['address'];
            $new_DOB = $_POST['DOB'];
            $new_username = $_POST['username'];
            $new_password = $_POST['password'];
            $new_location = $_POST['location'];

            // Update record in database
            $update_sql = "UPDATE administration SET name = ?, Address = ?, DOB = ?, username = ?, PASSWORD = ?, location = ? WHERE admin_ID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssssssi", $new_name, $new_address, $new_DOB, $new_username, $new_password, $new_location, $id);
            
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
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" placeholder="Name"><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" placeholder="Address"><br>
        <label for="DOB">Date of Birth:</label><br>
        <input type="date" id="DOB" name="DOB" placeholder="Date of Birth"><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" placeholder="Username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Password"><br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
