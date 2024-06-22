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
$sql = "SELECT * FROM upload_cv";
$result = mysqli_query($conn, $sql);

// Check if there are records
if (mysqli_num_rows($result) > 0) {
    // Display table header
    echo "<table border='1'>";
    echo "<tr><th>cv_ID</th><th>reg_ID</th><th>job_ID</th><th>CV</th></tr>";
    
    // Display records
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['cv_ID'] . "</td>";
        echo "<td>" . $row['reg_ID'] . "</td>";
        echo "<td>" . $row['job_ID'] . "</td>";
        echo "<td>" . $row['cv'] . "</td>";

    }
    
    echo "</table>";
} else {
    echo "No records found";
}

// Close connection
mysqli_close($conn);
?>
