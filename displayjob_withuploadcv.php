<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/postvacancyStyles.css".css>
</head>
<body>
    
</body>
</html>
<?php
include 'connection.php';
echo "<br>";

function fetchJobVacancies($conn) {
    $sql = "SELECT * FROM job_post ORDER BY updated_at DESC"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            echo "<div class='job_row'>"; 
            echo "<div class='job_section'>";
           
            echo "<div class='company_logo'>";
            echo "<img src='" . $row['company_image'] . "' alt='Company Logo'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='job_section'>";
            
            echo "<div class='company_details'>";
            echo "<h3>" . $row["job_title"]. "</h3>";
            echo "<p><strong>Company Name:</strong> " . $row["company_name"]. "</p>";
            echo "<p><strong>Location:</strong> " . $row["location"]. "</p>";
            echo "<p><strong>Job Type:</strong> " . $row["job_type"]. "</p>";
            echo "<a href='jobdetails2.php?job_id=" . $row["job_ID"] . "'><button>View Details</button></a>";
            echo "</div>";
            echo "</div>";
            echo "</div>"; 
            
        }

        
    } else {
        echo "No job vacancies available";
    }
}

fetchJobVacancies($conn);

$conn->close();

?>
