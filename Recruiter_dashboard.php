<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard_styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Recruiter Dashboard</h2>
        <ul>
            <li><a href="Post_job_vacancy.php">Post a job</a></li>
            <li><a href="Manage_job.php">Manage Jobs</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Registration Table</h2>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
          
            var sidebarLinks = document.querySelectorAll('.sidebar ul li a');

           
            sidebarLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                  
                    event.preventDefault();

                  
                    var href = this.getAttribute('href');

                   
                    fetch(href)
                        .then(response => response.text())
                        .then(data => {
                           
                            document.querySelector('.content').innerHTML = data;
                        })
                        .catch(error => console.error('Error fetching content:', error));
                });
            });
        });
    </script>
</body>
</html>

<?php
session_start();

if(!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}
?>


