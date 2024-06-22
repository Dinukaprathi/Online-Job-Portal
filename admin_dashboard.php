<?php
session_start();
// Check if user is logged in and is admin

if(!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard_styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="Manage_registration.php">Manage Registration</a></li>
            <li><a href="Manage_Admin.php">Manage Admins</a></li>
            <li><a href="Manage_cv.php">Manage CV</a></li>
            <li><a href="Manage_feedback.php">Manage Feedback</a></li>  
            <li><a href="Admin_logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Registration Table</h2>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get sidebar links
        var sidebarLinks = document.querySelectorAll('.sidebar ul li a');

        // Add click event listeners to each sidebar link
        sidebarLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                // Prevent the default link behavior
                event.preventDefault();

                // Get the href attribute value of the clicked link
                var href = this.getAttribute('href');

                // Check if the href is not equal to "logout.php"
                if (href !== "admin_login.php") {
                    // Fetch the content of the PHP file corresponding to the clicked link
                    fetch(href)
                        .then(response => response.text())
                        .then(data => {
                            // Insert the fetched content into the content area
                            document.querySelector('.content').innerHTML = data;
                        })
                        .catch(error => console.error('Error fetching content:', error));
                }
            });
        });
    });
</script>
</body>
</html>




