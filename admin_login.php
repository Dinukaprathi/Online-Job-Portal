<?php
session_start();
include 'connection.php'; // Include your database connection file

$error_message = ''; // Initialize error message variable

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        $error_message = "Username and password are required";
    } else {
        // Prepare and bind parameters
        $sql = "SELECT Admin_ID, name FROM administration WHERE username = ? AND PASSWORD = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['Admin_ID'];
            $_SESSION['fname'] = $row['name'];
            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error_message = "Incorrect username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="admin_login_styles.css">
</head>
<body>
<div class="login-container">
    <h1>Admin</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" name="submit" value="Login">

        <?php if($error_message): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    </form>
</div>
    
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
