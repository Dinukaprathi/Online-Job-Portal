<?php
include 'connection.php';

$searchTerm = "";
$category = "";
$drop_location = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST["searchbox"];
    $category = $_POST["select_category"];
    $drop_location = $_POST["location"];
}

$sql = "SELECT * FROM job_post WHERE 1 ";

if (!empty($searchTerm)) {
    $sql .= "AND job_title LIKE '%$searchTerm%' ";
}

if (!empty($category)) {
    $sql .= "AND job_title = '$category' ";
}

if (!empty($drop_location)) {
    $sql .= "OR location = '$drop_location' ";
}

$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='job_row'>";
            echo "<div class='job_section'>";
            echo "<div class='company_logo'>";
            echo "<img src='" . $row['company_image'] . "' alt='Company Logo'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='job_section'>";
            echo "<div class='company_details'>";
            echo "<h3>" . $row["job_title"] . "</h3>";
            echo "<p><strong>Company Name:</strong> " . $row["company_name"] . "</p>";
            echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
            echo "<p><strong>Job Type:</strong> " . $row["job_type"] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No job vacancies available";
    }
}
?>
