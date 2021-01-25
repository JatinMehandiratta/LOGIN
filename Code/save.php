<?php include 'db.php'; ?>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['reg_user'])) {
    $firstname  = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $age = $conn->real_escape_string($_POST['age']);
    $email = $conn->real_escape_string($_POST['email']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $occupation = $conn->real_escape_string($_POST['occupation']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirm_password']);

    if ($password != $confirmPassword) {
        header('location: signup.php?passwordmatcherr=true');
        exit;
    }
    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $sql = "SELECT *  FROM user_table  WHERE email = '$email' ";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['email'] === $email) {
        header('location: signup.php?alreadyregisteredmailerr=true');
        exit;
    } else {
        $sql = "INSERT INTO user_table (firstname, lastname, age,email,gender,occupation,password ,confirm_password)
VALUES ('" . $firstname . "','" . $lastname . "', '" . $age . "', '" . $email . "','" . $gender . "','" . $occupation . "','" . $password . "','" . $confirmPassword . "')";
        if (mysqli_query($conn, $sql)) {
            echo '<script> alert ("You have successfully Signed up")</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>