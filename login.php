<?php
session_start();
include 'connection.php';

$error_message = '';

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        $error_message = "Username and password are required";
    } else {
        $sql = "SELECT reg_ID, username, usertype, Fname FROM registration WHERE username = ? AND Password = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['reg_ID'];
            $_SESSION['user_type'] = $row['usertype'];
            $_SESSION['fname'] = $row['Fname'];
            if ($row['usertype'] === 'jobseeker') {
                header("Location:job_seeker_dashboard.php");
            } elseif ($row['usertype'] === 'recruiter') {
                header("Location: Recruiter_dashboard.php");
            } else {
                header("Location: generic_dashboard.php");
            }
            exit();
        }else{
            $error_message = "Incorrect username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login_Styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" name="submit" value="Login">
        </form>
        <p id="registration_link">Don't have an Account?<a href="Registration.php">Register</a></p>

        <?php if($error_message): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
