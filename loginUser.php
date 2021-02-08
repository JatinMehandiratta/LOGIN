<?php
session_start();
function logger($email, $password)
{
    global $conn;
    $query = "SELECT * FROM user_table WHERE BINARY email= '$email' AND BINARY password= '$password' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['firstname'];
    }
    if (isset($_SESSION['id'])) {
        header("Location: index.php");
    }
}
