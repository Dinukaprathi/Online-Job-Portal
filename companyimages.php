<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="companyimages.css">
</head>
<body>
<?php

include 'connection.php';

function displayCompanyImages($conn) {
    $sql = "SELECT company_image FROM job_post";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Error: " . $conn->error;
    } elseif ($result->num_rows > 0) {
       
        while($row = $result->fetch_assoc()) {
           
            echo "<div class='company_image'>";
            echo "<img src='" . $row['company_image'] . "' alt='Company Logo'>";
            echo "</div>";
        }
    } else {
    
        echo "No data available";
    }
}

displayCompanyImages($conn);

?>
</body>
</html>

