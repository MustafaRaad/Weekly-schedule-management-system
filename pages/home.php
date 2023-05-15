<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: /wsms/user/login.php");

  exit;
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Weekly schedule management system</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
  <?php
  include  'header.php';
  ?>
  <section class="container p-3">
    <div class="d-flex">
      <button class="col border m-3 p-5">
        <a class="nav-link active" aria-current="page" href="/wsms/pages/classes.php?page=classes_list">الصفوف</a>
      </button>
      <button class="col border m-3 p-3">
        <a class="nav-link active" aria-current="page" href="/wsms/pages/materials.php?page=materials_list">المواد</a>
      </button>
      <button class="col border m-3 p-3">
        <a class="nav-link active" aria-current="page" href="/wsms/pages/teachers.php?page=teachers_list">المدرسين</a>
      </button>
    </div>

  </section>
  <section class="container p-3">
    <div class="row justify-center">
      <div class="col-10 text-center m-auto p-5 ">
        <button class="btn btn-primary btn-lg btn-block">
          <a class="nav-link active" aria-current="page" href="/wsms/pages/schedules.php?page=add_schedules">+ اضافة جدول</a>
        </button>
      </div>
    </div>
  </section>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>