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
  <title>Admin Panel</title>
</head>

<body>
  <?php
  include  'header.php';
  ?>

  <div class="container mt-5">
    <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];

      switch ($page) {
        case 'users_list':
          include './admin/users_list.php';
          break;
        case 'add_user':
          include './admin/add_user.php';
          break;
        case 'teachers_list':
          include './admin/teachers_list.php';
          break;
        case 'add_teachers':
          include './admin/add_teachers.php';
          break;
        default:
          echo 'Page not found';
          break;
      }
    } else { ?>
      <section class="container">
        <ul class="nav nav-pills nav-fill p-4">
          <li class="nav-item border rounded">
            <a class="nav-link" aria-current="page" href="admin.php?page=users_list">قائمة المستخدمين</a>
          </li>
          <li class="nav-item border rounded">
            <a class="nav-link" href="admin.php?page=add_user">اضافة مستخدم</a>
          </li>
          <li class="nav-item border rounded">
            <a class="nav-link" aria-current="page" href="admin.php?page=teachers_list">قائمة المدرسين</a>
          </li>
          <li class="nav-item border rounded">
            <a class="nav-link" href="admin.php?page=add_teachers">اضافة مدرس</a>
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