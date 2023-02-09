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
            <a class="nav-link active" aria-current="page" href="/pages/home.php">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " href="./admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" href="./user_profile.php"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="../users/user_logout.php" >Logout ></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="container p-3">
    <h1>This is the Homepage</h1>

  </section>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>