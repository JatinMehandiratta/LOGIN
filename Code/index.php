<?php
include 'db.php';
include 'header.php';
include 'modifyRecord.php';
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
if (isset($_GET['updatesuccess'])) {
    echo  '<div class="alert alert-success">Record Updated Successfully</div>';
}
if (isset($_GET['deletesuccess'])) {
    echo  '<div class="alert alert-danger">Record Deleted Successfully</div>';
}
?>
<div class="container-fluid mb-4">
    <div class="header mt-0 mb-3">
        <h2>Home Page</h2>
    </div>
    <div class="d-flex justify-content-around">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
            <div class="row  ml-4 mr-4 p-3">
                <div class="col-sm-5">
                    <input type="text" name="search" autocomplete="off">
                    <button type="submit" class="btm btn-success" value="<?php echo $_GET['search']; ?>">Search</button>
                                    </div>
            </div>
        </form>
    </div>
    <div class="row ml-4 mr-4 p-3">
        </h3><strong>Welcome <?php echo $_SESSION["name"]; ?></strong></h3>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Age</td>
                    <td>Email</td>
                    <td>Gender</td>
                    <td>Occupation</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $results_per_page = 5;
                if (isset($_GET['search'])) {
                    $search = htmlspecialchars($_GET['search']);
                    $squery = "SELECT * FROM `user_table` WHERE `id` LIKE '%" . $search . "%' or `firstname` LIKE '%" . $search . "%' or `lastname` LIKE '%" . $search . "%' or `age` LIKE '%" . $search . "%' or `email` LIKE '%" . $search . "%' or `gender` LIKE '%" . $search . "%' or `occupation` LIKE '%" . $search . "%' ";
                    $searchresult = mysqli_query($conn, $squery)  or die(mysqli_error($conn));
                    $search_result = mysqli_num_rows($searchresult);
                    $number_of_searches = ceil($search_result / $results_per_page);
                    if (isset($_GET['find'])) {
                        $find = $_GET['find'];
                    } else {
                        $find = 1;
                    }
                    $search_first_result = ($find - 1) * $results_per_page;
                    $searchquery = mysqli_query($conn, "SELECT * FROM `user_table` WHERE `id` LIKE '%" . $search . "%' or `firstname` LIKE '%" . $search . "%' or `lastname` LIKE '%" . $search . "%' or `age` LIKE '%" . $search . "%' or `email` LIKE '%" . $search . "%' or `gender` LIKE '%" . $search . "%' or `occupation` LIKE '%" . $search . "%' LIMIT " . $search_first_result . ',' . $results_per_page)
                        or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_assoc($searchquery)) { ?>
                        <tr id="row<?php echo $row['id']; ?>">
                            <td id="fname_val<?php echo $row['id']; ?>"><?php echo $row['firstname'] ?></td>
                            <td id="lname_val<?php echo $row['id']; ?>"><?php echo $row['lastname'] ?></td>
                            <td id="age_val<?php echo $row['id']; ?>"><?php echo $row['age'] ?></td>
                            <td id="email_val<?php echo $row['id']; ?>"><?php echo $row['email'] ?></td>
                            <td id="gender_val<?php echo $row['id']; ?>"><?php echo $row['gender'] ?></td>
                            <td id="occu_val<?php echo $row['id']; ?>"><?php echo $row['occupation'] ?></td>
                            <td>
                                <button class="edit_button  btn-primary btn-sm" name="edit_btn" id="edit_button<?php echo $row['id']; ?>" value="edit" onclick="edit_row('<?php echo $row['id']; ?>');">Edit</button>
                                <button type='button' class="save_button  btn-primary btn-sm" style="display: none;" name="save_btn" id="save_button<?php echo $row['id']; ?>" value="save" onclick="save_row('<?php echo $row['id']; ?>');">Save</button>
                                <button type='button' class="delete_button btn-danger btn-sm" name="del_btn" id="delete_button<?php echo $row['id']; ?>" value="delete" onclick="delete_row('<?php echo $row['id']; ?>');">Delete</button>
                            </td>
                        </tr>
                    <?php }
                     for ($find = 1; $find <= $number_of_searches; $find++) {
                        $pagelink = '<a href = "index.php?find=' . $find . '">' . $find . ' </a>';
                    }   
                } else {
                    $query = "select * from user_table";
                    $result = mysqli_query($conn, $query);


                    $number_of_result = mysqli_num_rows($result);

                    //determine the total number of pages available  
                    $number_of_page = ceil($number_of_result / $results_per_page);

                    //determine which page number visitor is currently on  
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $page_first_result = ($page - 1) * $results_per_page;
                    $allquery = mysqli_query($conn, "SELECT * FROM `user_table`  LIMIT " . $page_first_result . ',' . $results_per_page)
                        or die(mysqli_error($conn));


                    while ($row = mysqli_fetch_assoc($allquery)) { ?>
                        <tr id="row<?php echo $row['id']; ?>">
                            <td id="fname_val<?php echo $row['id']; ?>"><?php echo $row['firstname'] ?></td>
                            <td id="lname_val<?php echo $row['id']; ?>"><?php echo $row['lastname'] ?></td>
                            <td id="age_val<?php echo $row['id']; ?>"><?php echo $row['age'] ?></td>
                            <td id="email_val<?php echo $row['id']; ?>"><?php echo $row['email'] ?></td>
                            <td id="gender_val<?php echo $row['id']; ?>"><?php echo $row['gender'] ?></td>
                            <td id="occu_val<?php echo $row['id']; ?>"><?php echo $row['occupation'] ?></td>
                            <td>
                                <button class="edit_button  btn-primary btn-sm" name="edit_btn" id="edit_button<?php echo $row['id']; ?>" value="edit" onclick="edit_row('<?php echo $row['id']; ?>');">Edit</button>
                                <button type='button' class="save_button  btn-primary btn-sm" style="display: none;" name="save_btn" id="save_button<?php echo $row['id']; ?>" value="save" onclick="save_row('<?php echo $row['id']; ?>');">Save</button>
                                <button type='button' class="delete_button btn-danger btn-sm" name="del_btn" id="delete_button<?php echo $row['id']; ?>" value="delete" onclick="delete_row('<?php echo $row['id']; ?>');">Delete</button>
                            </td>
                        </tr>
                <?php }
                for ($page = 1; $page <= $number_of_page; $page++) {
                    $pagelink = '<a href = "index.php?find=' . $page . '">' . $page . ' </a>';
                }   
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="text-center">
    <?php
    echo $pagelink?>
</div>
<script type="text/javascript">
    $(function() {
        $("#save_btn" + id).show();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script type="text/javascript" src="modify_record.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</body>

</html>
