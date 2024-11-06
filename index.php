<?php
session_start();// Starting Session
if(!isset($_SESSION['username'])){ // If session is not set then redirect to Login Page
    header("Location: login.php"); // Redirecting To Login Page
    exit(); // Stop script
}
?>

<html>
<head>
    <title>Users List</title>
</head>

<body>
<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<a href="logout.php">Logout</a>


    <h2> Users List </h2>
    <table border="1">
        <tr>
            <td> ID </td>
            <td> Name </td>
            <td> Email </td>
            <td> Edit </td>
            <td> Delete </td>
        </tr>
        <?php
        include "db_conn.php"; // Using database connection file here

       $sql = "SELECT * FROM users";
       $result = mysqli_query($conn, $sql);

       if(mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)){
               echo "<tr>";
               echo "<td>". $row['id'] . "</td>";
               echo "<td>". $row['name'] . "</td>";
               echo "<td>". $row['email'] . "</td>";
               echo "<td> <a href='update.php?id=". $row['id'] . "'> Edit </a> </td>";
               echo "<td> <a href='delete.php?id=". $row['id'] . "'> Delete </a> </td>";
               echo "</tr>";
           }
         }else{
               echo "<tr><td colspan='5'> No Data Found </td></tr>";
       }
        ?>
        </table>

        <a href="create.php">Add New User</a>
</body>
</html>