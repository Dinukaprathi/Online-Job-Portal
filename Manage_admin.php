<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Manage_registration_styles.css">
<body>
    
</body>
</html>
<?php
// Include database connection
include 'connection.php';

// Read operation - Display all records
$sql = "SELECT * FROM administration";
$result = mysqli_query($conn, $sql);

// Check if there are records
if (mysqli_num_rows($result) > 0) {
    // Display table header
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>First name</th><th>Last name</th><th>Username</th><th>User Type</th><th>Password</th></tr>";
    
    // Display records
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['admin_ID'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['Address'] . "</td>";
        echo "<td>" . $row['DOB'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['PASSWORD'] . "</td>";

        echo "<td><a href='update_Admin.php?id=" . $row['admin_ID'] . "'>Update</a> | <a href='Delete_admin.php?id=" . $row['admin_ID'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No records found";
}

// Close connection
mysqli_close($conn);
?>
