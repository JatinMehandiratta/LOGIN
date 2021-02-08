    <?php include 'header.php';
    include 'db.php';
    session_start();
    if (isset($_SESSION['id'])) {
        header("Location: index.php");
    }
    if (isset($_GET['logoutsuccess'])) {
        echo '<div class="alert alert-success">Log Out Successfull</div>';
    };

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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
    $email_error = "";
    $password_error = "";
    $email = "";



    if (isset($_POST['login_user'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password =  $conn->real_escape_string($_POST['password']);
        $notemail = "";
        $dbpass = "";

        $sql = "SELECT *  FROM user_table  WHERE email = '$email' ";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if (!empty($row['email']) && !empty($row['password'])) {
            $notemail = ($row['email']);
            $dbpass = ($row['password']);
        }
        if ($email !==  $notemail) {
            echo '<div class = "alert alert-danger">This email is not Registered with us Please Sign up</div>';
        }



        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email ID";
        } elseif (empty($email)) {
            $email_error = "Please enter your Email id";
        }
        if (empty($password)) {
            $password_error = "Please Enter your Password to Login";
        } elseif ($password !== $dbpass) {
            $password_error = "The email and password combination do not match";
        }
        if (empty($email_error) && empty($password_error)) {
            logger($email, $password);
        }
    }
    ?>
    <div class="jumbotron bg-secondary mt-2 mb-4 p-3">
        <h1 class="text-center">User Login Page</h1>
    </div>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control mt-2 mb-2 p-2" value="<?php echo $email; ?>">
                <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control mt-2 mb-2 p-2">
                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
            </div>
            <div class="form-group mt-2 mb-2 p-2">
                <button type="submit" class="btn btn-primary" name="login_user">Login</button>
            </div>
            <p>
                Not yet a member? <a href="signup.php">Sign up</a>
            </p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    </body>

    </html>