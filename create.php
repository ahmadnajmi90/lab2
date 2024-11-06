<?php
session_start();// Starting Session
if(!isset($_SESSION['username'])){ // If session is not set then redirect to Login Page
    header("Location: login.php"); // Redirecting To Login Page
    exit(); // Stop script
}
?>

<html>
<head>
    <title>Add Users</title>
</head>

<body>
    <h2> Add Users </h2>
    <form action="create.php" method="POST">
        <label> Name: </label>
        <input type="text" name="name" required>
        <label> Email: </label>
        <input type="email" name="email" required>
        <button type="submit"> Add User </button>
    </form>

    <a href="index.php">Back to User List</a>
</html>

<?php

include "db_conn.php"; // Using database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
