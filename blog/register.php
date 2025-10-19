<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myblog";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='register.php';</script>";
        exit();
    }

    

    if ($result->num_rows > 0) {
        echo "<script>alert('User ID already exists!'); window.location.href='register.php';</script>";
        exit();
    }

    // Insert new user
   // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO register (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $userid, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please log in.'); window.location.href='home.html';</script>";
    } else {
        echo "<script>alert('Error during registration. Please try again.'); window.location.href='register.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | BlogSite</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-wrapper">
    <section class="login-card">
        <h2>Create Account</h2>
        <form action="" method="post" class="login-form">
            <div class="form-group">
                <label>User ID (Email)</label>
                <input type="text" name="userid" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>

            <button type="submit" name="submit" class="btn">Register</button>
        </form>

        <p class="register-link">
            Already a user? <a href="login.php">Login here</a>
        </p>
        <p class="register-link">
            <a href="home.html">Back to Home</a>
        </p>
    </section>
</div>

</body>
</html>
