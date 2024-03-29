<?php
require_once "../connection.php";
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: /wsms/user/login.php");

  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link href="../assets/css/style.css" rel="stylesheet">
  <title>Classes</title>
</head>

<body>
  <?php
  include 'header.php';
  ?>

  <div class="container mt-5">
    <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];

      switch ($page) {
        case 'classes_list':
          include './classes/classes_list.php';
          break;
        case 'add_class':
          include './classes/add_class.php';
          break;
        default:
          echo 'Page not found';
          break;
      }
    } else { ?>
      <section class="container">
        <ul class="nav nav-pills nav-fill p-4">
          <li class="nav-item border rounded">
            <a class="nav-link " aria-current="page" href="classes.php?page=classes_list">قائمة الصفوف</a>
          </li>
          <li class="nav-item border rounded">
            <a class="nav-link " href="classes.php?page=add_class">اضافة صف</a>
          </li>
        </ul>
      </section>
    <?php
    }
    ?>
  </div>

  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>