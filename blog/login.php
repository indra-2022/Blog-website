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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM register WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $userid, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $userid; // Store email in session
        echo "<script>alert('Login Successful! Click OK to continue!'); window.location.href='blog.php';</script>";

    } else {
        echo "<script>alert('Invalid User ID or Password!'); window.location.href='login.php';</script>";
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
    <title>Login Page</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>

<div class="container">
    <div class="login-box">
        <h2>Login</h2>
        <!-- ✅ FIXED action -->
        <form action="" method="post">
            <label for="userid">User ID</label>
            <input type="text" id="userid" name="userid" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p class="register-link">Not a user? <a href="register.php">Register here</a></p>
        <p class="register-link">
            <a href="home.html">Back to Home</a>
        </p>
    </div>
</div>

</body>
</html>
