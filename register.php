<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <h2> Register </h2>
        <form action="register.php" method="POST">
            <label for="name">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Register">
        </form>

        <a href="login.php">Already have an account? Login here</a>
    </body>
</html>
<?php
include "db_conn.php"; // Using database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
    $username = mysqli_real_escape_string($conn,$_POST['username']); // Get the username value from the form
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Get the password value from the form

    $sql = "INSERT INTO users_reg (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>