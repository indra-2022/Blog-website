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

    if(isset($_POST['publish']) && isset($_SESSION['email'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];

        //fetching email from register table
        $email=$_SESSION['email'];


        // Insert blog post into database
        $stmt = $conn->prepare("INSERT INTO blog (title, author, content,email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $author, $content, $email);

        if ($stmt->execute()) {
            echo "<script>alert('Blog published successfully!'); window.location.href='blog.php';</script>";
        } else {
            echo "<script>alert('Error publishing blog. Please try again.'); window.location.href='publish.php';</script>";
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
    <title>Publish Blog | BlogSite</title>
    <link rel="stylesheet" href="publish.css">
</head>
<body>

    <div class="container">
        <h2>Publish Your Blog</h2>
        <form action="" method="post" class="publish-form">
            
            <div class="form-group">
                <label>Blog Title</label>
                <input type="text" name="title" placeholder="Enter blog title" required>
            </div>

            <div class="form-group">
                <label>Author Name</label>
                <input type="text" name="author" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label>Your Blog</label>
                <textarea name="content" rows="8" placeholder="Write your blog here..." required></textarea>
            </div>

            <button type="submit" name="publish" class="btn">Publish Blog</button>
        </form>
    </div>

</body>
</html>
