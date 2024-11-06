<?php
session_start();// Starting Session
if(!isset($_SESSION['username'])){ // If session is not set then redirect to Login Page
    header("Location: login.php"); // Redirecting To Login Page
    exit(); // Stop script
}
?>

<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2> Update User </h2>

    <?php

    include "db_conn.php"; // Using database connection file here

    if(isset($_GET['id'])){ // Check if id parameter is available inside url
        $id = $_GET['id']; // Get the id parameter value
        $sql = "SELECT * FROM users WHERE id=$id"; // SQL query to select user data based on id
        $result = mysqli_query($conn, $sql); // Execute the query
        $row = mysqli_fetch_assoc($result); // Fetch the result set into an associative array
    }

    ?>
    <form action="update.php?id=<?php echo $row['id']; ?>" method="POST">
        <label> Name: </label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
        <label> Email: </label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <button type="submit"> Update User </button>
    </form>


   <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id"; // SQL query to update user data based on id

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }


    ?>
    <br>
    <a href="index.php">Back to User List</a>
    </body>


</html>