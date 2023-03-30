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
    <!-- <div class="d-flex">
      <button class="col border m-3 p-3">المواد</button>
      <button class="col border m-3 p-3">المواد</button>
      <button class="col border m-3 p-3">المواد</button>
    </div> -->

  </section>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>