<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Registration.css">
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required><br><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" required>
            <option value="jobseeker">Job seeker</option>
            <option value="recruiter">Recruiter</option>
        </select><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="re_password">Re-enter Password:</label>
        <input type="password" id="re_password" name="re_password" required><br><br>

        <input type="submit" value="Register">
    </form>

    <script>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            alert("Registration successful!");
        <?php endif; ?>
    </script>
</body>
</html>
<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // Validate form data
    if ($password != $re_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Insert user data into the database
    $sql = "INSERT INTO registration (Fname, Lname, username, usertype, Password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $user_type, $password);
    
    if (mysqli_stmt_execute($stmt)) {
        // Registration successful, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
