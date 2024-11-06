<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2> Login </h2>
    <form action="login.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
    </form>

    <a href="register.php">Don't have an account? Register here</a>
</body>
</html>

<?php
session_start();// Starting Session
include "db_conn.php"; // Using database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
    $username = mysqli_real_escape_string($conn,$_POST['username']); // Get the username value from the form
    $password = $_POST['password']; // Get the password value from the form

    $sql = "SELECT * FROM users_reg WHERE username = '$username'";// Query the database for user
    $result = mysqli_query($conn, $sql);// Run the query

    if (mysqli_num_rows($result) == 1){// Check if user exists
        $row = mysqli_fetch_assoc($result);// Get the data from the database
        if (password_verify($password, $row['password'])) {// Check if the password matches
            $_SESSION['username'] = $username;// Set the session variable
            header("Location: index.php");// Redirect to the home page
        } else {// If the password doesn't match
            echo "Invalid username or password";// Display an error message
        }
    } else {// If the user doesn't exist
        echo "No user found with that username";// Display an error message
    }
}

?>
