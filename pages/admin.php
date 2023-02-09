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
  <title>Admin Panel</title>
</head>

<body>
  <nav class="navbar navbar-expand bg-success-subtle px-5">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="/pages/home.php">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="./admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary " href="./user_profile.php"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="../users/user_logout.php">Logout ></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

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
        default:
          echo 'Page not found';
          break;
      }
    } else { ?>
      <section class="container">
        <ul class="nav nav-pills nav-fill p-4">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="admin.php?page=users_list">Users List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin.php?page=add_user">Add User</a>
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