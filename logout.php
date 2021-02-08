<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
session_destroy();
header("Location:login.php?logoutsuccess");




// <div class="text-center">
//     <?php if (!empty($_GET['search']) ){
//          for ($find = 1; $find <= $number_of_searches; $find++) {
//             $pageLink .= "<a href='index.php?find="
//                 . $find . "'>" . $find . "</a>";
//     }}
// else{
//     for ($page = 1; $page <= $number_of_page; $page++) {
//         $pageLink .= "<a href='index.php?page="
//             . $page . "'>" . $page . "</a>";
//     }
// }
//     echo $pageLink;
//     ?>
// </div>
