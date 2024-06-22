<?php
include 'connection.php';

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Retrieve record from database
    $sql = "SELECT * FROM registration WHERE reg_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['Fname'];
        $lname = $row['Lname'];
        $email = $row['username'];
    } else {
        echo "Record not found";
        exit();
    }
} else {
    echo "ID parameter is missing";
    exit();
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get updated data
    $new_fname = $_POST['Fname'];
    $new_lname = $_POST['Lname'];
    $new_email = $_POST['username'];
    
    // Update record in database
    $update_sql = "UPDATE registration SET Fname = ?, Lname = ?, username = ? WHERE reg_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $new_fname, $new_lname, $new_email, $id);
    
    if($update_stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $update_stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
</head>
<body>
    <h2>Update Record</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
        <label for="Fname">First Name:</label><br>
        <input type="text" id="Fname" name="Fname" value="<?php echo $name; ?>" placeholder="New First Name" required><br>
        <label for="Lname">Last Name:</label><br>
        <input type="text" id="Lname" name="Lname" value="<?php echo $lname; ?>" placeholder="New Last Name" required><br>
        <label for="username">Username:</label><br>
        <input type="email" id="username" name="username" value="<?php echo $email; ?>" placeholder="New Username" required><br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
