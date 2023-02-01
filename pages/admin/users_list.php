<?php
include '../../connection.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Weekly schedule management system</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
            <a class="nav-link " aria-current="page" href="../home.php">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="./users_list.php">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="container">
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./users_list.php">Users List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./add_user.php">Add User</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li> -->
    </ul>
  </section>
  <section class="container bg-body-tertiary p-3">
    <?php
    if (isset($error)) {
      echo "<p style='color:red;'>$error</p>";
    } else {
      $sql = "SELECT * FROM users";
      // Execute the query
      $result = mysqli_query($conn, $sql);
    }
    if (mysqli_num_rows($result) > 0) {
    ?>
      <table class="table">
        <thead>
          <th scope="col">ID</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
        </thead>
        <tbody>

          <?php // Write the SQL query
          // Check if the query was successful
          // Fetch the results into an array
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><th scope='row'>" . $row["id"] . "</th>" . "<td scope='row'>" . $row["username"] . "</td>" . "<td scope='row'>" . $row["email"] . "</td>";
          }
          ?>

        </tbody>
      </table>
    <?php
    } else {
      echo "No users found.";
    }
    // Close the connection
    mysqli_close($conn);
    ?>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>