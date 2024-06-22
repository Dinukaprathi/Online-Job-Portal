<?php
include 'connection.php';

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete record from database
    $delete_sql = "DELETE FROM job_post WHERE job_ID = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $id);
    
    if($delete_stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $delete_stmt->error;
    }
} else {
    echo "ID parameter is missing";
    exit();
}
?>
