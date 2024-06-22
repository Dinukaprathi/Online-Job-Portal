<?php
// Include database connection
include 'connection.php';

// Read operation - Display all records
$sql = "SELECT * FROM job_post";
$result = mysqli_query($conn, $sql);

// Check if there are records
if (mysqli_num_rows($result) > 0) {
    // Display table header
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Job Title</th><th>Description</th><th>Company Name</th><th>Location</th><th>Job Type</th><th>Email</th><th>Expire Date</th><th>Expire Date</th><th>Image</th><th>Action</th></tr>";
    
    // Display records
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['job_ID'] . "</td>";
        echo "<td>" . $row['job_title'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['company_name'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
        echo "<td>" . $row['job_type'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['expire_date'] . "</td>";
        echo "<td>" . $row['expire_date'] . "</td>";
        echo " <td> <img src='" . $row['company_image'] . "' alt='Company Logo'> <td>";
        echo "<td><a href='update_job.php?id=" . $row['job_ID'] . "'>Update</a> | <a href='Delete_job.php?id=" . $row['job_ID'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

// Close connection
mysqli_close($conn);
?>
