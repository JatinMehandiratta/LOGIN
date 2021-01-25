<?php include 'db.php'; ?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['login_user'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT *  FROM user_table  WHERE email = '$email' ";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['email'] != $email) {
        header('location: login.php?notregiterederr=true');
        exit;
    }
    $query = "SELECT * FROM user_table WHERE email= '$email' AND password= '$password' ";
    $result = mysqli_query($conn, $query);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
      
    if($count == 1){  
        echo "<h1><center> Login successful </center></h1>";  
        header('location: index.php');
    } else {
        header('location: login.php?invalidLogin=true');
    }
}
?>