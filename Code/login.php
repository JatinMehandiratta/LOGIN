<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<style>
    body {
        font-size: 120%;
        background: #F8F8FF;
    }

    .header {
        width: 30%;
        margin: 50px auto 0px;
        color: white;
        background: #5F9EA0;
        text-align: center;
        border: 1px solid #B0C4DE;
        border-bottom: none;
        border-radius: 10px 10px 0px 0px;
        padding: 20px;
    }

    form,
    .content {
        width: 30%;
        margin: 0px auto;
        padding: 20px;
        border: 1px solid #B0C4DE;
        background: white;
        border-radius: 0px 0px 10px 10px;
    }

    .input-group {
        margin: 10px 0px 10px 0px;
    }

    .input-group label {
        display: block;
        text-align: left;
        margin: 3px;
    }

    .input-group input {
        height: 30px;
        width: 93%;
        padding: 5px 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid black;
    }

    .btn {
        padding: 10px;
        font-size: 15px;
        color: white;
        background: #5F9EA0;
        border: none;
        border-radius: 5px;
    }

    .error {
        width: 92%;
        margin: 0px auto;
        padding: 10px;
        border: 1px solid #a94442;
        color: #a94442;
        background: #f2dede;
        border-radius: 5px;
        text-align: left;
    }

    .success {
        color: #3c763d;
        background: #dff0d8;
        border: 1px solid #3c763d;
        margin-bottom: 20px;
    }
</style>

<body>
    <?php 
   if(isset ($_GET['notregiterederr']))  {
    echo '<script>alert( "This User is not registered with us ! Please Register First")</script>';
    };
    if (isset($_GET['invalidLogin'])) {
        echo '<script> alert("Wrong username/password combination")</script>';
    };
    ?>
    <div class="jumbotron bg-secondary mt-2 mb-4 p-3">
        <h1 class="text-center">User Login Page</h1>
    </div>

    <form method="post" action="loginUser.php">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control mt-2 mb-2 p-2" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control mt-2 mb-2 p-2" required>
        </div>
        <div class="form-group mt-2 mb-2 p-2">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="signup.php">Sign up</a>
        </p>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
</body>

</html>