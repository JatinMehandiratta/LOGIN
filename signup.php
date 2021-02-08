  <?php
    include 'db.php';
    include 'header.php';
    include 'loginUser.php';


    if (isset($_SESSION['id'])) {
        header("Location: index.php");
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);




    $firstname_error = "";
    $lastname_error = "";
    $email_error = "";
    $gender_error = "";
    $occupation_error = "";
    $password_error = "";
    $confirmpassword_error = "";
    $firstname = "";
    $lastname = "";
    $age = "";
    $email = "";
    $occupation = "";
    $gender = "";

    if (isset($_POST['reg_user'])) {
        $firstname  = $conn->real_escape_string($_POST['firstname']);
        $lastname = $conn->real_escape_string($_POST['lastname']);
        $age = $conn->real_escape_string($_POST['age']);
        $email = $conn->real_escape_string($_POST['email']);
        if (isset($_POST['gender'])) {
            $gender = $conn->real_escape_string($_POST['gender']);
        } else {
            $gender = "";
        }
        $occupation = $conn->real_escape_string($_POST['occupation']);
        $password = $conn->real_escape_string($_POST['password']);
        $confirmPassword = $conn->real_escape_string($_POST['confirm_password']);
        $alreadymail = "";


        $sql = "SELECT *  FROM user_table  WHERE email = '$email' ";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if (!empty($row['email'])) {
            $alreadymail = ($row['email']);
        }
        if (empty($firstname)) {
            $firstname_error = "Please enter your firstname";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
            $firstname_error = "Name must contain only alphabets and space";
        }
        if (empty($lastname)) {
            $lastname_error = "Please enter your lastname";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
            $lastname_error = "Name must contain only alphabets and space";
        }
        if (empty($age)) {
            $age_error = "Please enter your age";
        }
        if (empty($email)) {
            $email_error = "Please enter your email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($email)) {
            $email_error = "Please Enter Valid Email ID";
        } elseif ($email == $alreadymail) {
            $email_error = "This Email is already registered with us either login or use another email";
        }
        if (empty($gender)) {
            $gender_error = "Please select your gender";
        }
        if (empty($occupation)) {
            $occupation_error = "Please Enter your Occupation";
        }
        if (empty($password)) {
            $password_error = "Please enter your password";
        } elseif (strlen($password) < 6) {
            $password_error = "Password must be minimum of 6 characters";
        }
        if (empty($confirmPassword)) {
            $confirmpassword_error = "Please enter your Confirm Password";
        } elseif ($confirmPassword != $password) {
            $confirmpassword_error = "Password and Confirm Password do not match";
        }

        if (empty($firstname_error) && empty($lastname_error) && empty($age_error) && empty($email_error) && empty($gender_error) && empty($occupation_error) && empty($password_error) && empty($confirmpassword_error)) {
            $sql = "INSERT INTO user_table (firstname, lastname, age,email,gender,occupation,password ,confirm_password)
    VALUES ('" . $firstname . "','" . $lastname . "', '" . $age . "', '" . $email . "','" . $gender . "','" . $occupation . "','" . $password . "','" . $confirmPassword . "')";
            if (mysqli_query($conn, $sql)) {
                echo  '<script>alert("You have Successfully signed up")</script>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            logger($email, $password);
        }
    }
    mysqli_close($conn);
    ?>

  <div class="jumbotron bg-secondary mt-2 mb-4 p-3">
      <h1 class="text-center">User Sign Up Page</h1>
  </div>
  <div class="container">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="firstname" class="mb-2">First name</label>
                      <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="<?php echo $firstname; ?>">
                      <span class="text-danger"><?php if (isset($firstname_error)) echo $firstname_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="lastname" class="mb-2">Last name</label>
                      <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" value="<?php echo $lastname; ?>">
                      <span class="text-danger"><?php if (isset($lastname_error)) echo $lastname_error; ?></span>
                  </div>
              </div>
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="age" class="mb-2">Age</label>
                      <input type="number" class="form-control" name="age" placeholder="Enter Your Age" value="<?php echo $age; ?>">
                      <span class="text-danger"><?php if (isset($age_error)) echo $age_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="email" class="mb-2">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
                      <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                  </div>
              </div>
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="gender" class="mb-2">Gender</label>
                      <br>
                      <label> <input type="radio" name="gender" <?php if (isset($gender) &&  $gender == "male")
                                                                    echo "checked"; ?> value="male"> Male</label><br>
                      <label><input type="radio" name="gender" <?php if (isset($gender) &&  $gender == "female")
                                                                    echo "checked"; ?> value="female"> Female</label><br>
                      <label><input type="radio" name="gender" <?php if (isset($gender) &&  $gender == "other")
                                                                    echo "checked"; ?> value="other"> Other</label><br>
                      <span class="text-danger"><?php if (isset($gender_error)) echo $gender_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="occupation" class="mb-2">Occupation</label>
                      <input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>">
                      <span class="text-danger"><?php if (isset($occupation_error))  echo $occupation_error; ?></span>
                  </div>
              </div>
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="password" class="mb-2">Password</label>
                      <input type="password" class="form-control" name="password">
                      <span class="text-danger"><?php if (isset($password_error))  echo $password_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="confirm_password" class="mb-2">Confirm Password</label>
                      <input type="password" class="form-control" name="confirm_password">
                      <span class="text-danger"><?php if (isset($confirmpassword_error)) echo $confirmpassword_error; ?></span>
                  </div>
              </div>
              <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary" name="reg_user">Submit</button>
                  <button type="reset" class="btn btn-primary  ml-2">Reset</button>
              </div>
          </div>
      </form>
      <p class="mt-4">
          Already a member? <a href="login.php">Sign in</a>
      </p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  </body>

  </html>