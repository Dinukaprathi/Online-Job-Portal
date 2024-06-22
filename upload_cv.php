<?php
session_start();
include 'connection.php';

$error_message = '';

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Get form data
    $reg_id = $_SESSION['user_id'];
    $job_id = $_POST['job_id'];
    
    // File upload handling
    if(isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        // Generate a unique filename
        $filename = uniqid() . '_' . basename($_FILES['cv']['name']);
        
        // Set the upload directory (absolute path)
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads';

        // Make sure the directory exists, if not, create it
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory recursively with full permissions
        }

        // Move the uploaded file to the upload directory
        if(move_uploaded_file($_FILES['cv']['tmp_name'], $upload_dir . '/' . $filename)) {
            // Prepare the SQL query using prepared statements
            $sql = "INSERT INTO upload_cv (reg_ID, job_ID, cv) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $reg_id, $job_id, $filename); // Assuming 'cv' column is VARCHAR type
            
            // Execute the query
            if($stmt->execute()) {
                $error_message = "CV uploaded successfully!";
            } else {
                $error_message = "Error uploading CV: " . $stmt->error;
            }
        } else {
            $error_message = "Error moving uploaded file to destination directory.";
        }
    } else {
        $error_message = "No file uploaded or file upload error!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload CV</title>
    <link rel="stylesheet" href="upload_cv.css">
</head>
<body>
    <h1>Upload CV</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?php echo isset($_GET['job_id']) ? $_GET['job_id'] : ''; ?>">
        <label for="cv">Select CV (upload a PNG or JPEG file):</label><br>
        <input type="file" id="cv" name="cv" accept="image/png, image/jpeg" required><br> <!-- Restrict file selection to PNG and JPEG images -->
        <input type="submit" name="submit" value="Upload">
    </form>
    <?php if($error_message): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
</body>
</html>
