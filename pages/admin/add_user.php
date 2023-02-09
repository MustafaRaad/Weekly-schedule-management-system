<?php
include '../../connection.php';

// Initialize variables for storing the form data
$username = "";
$email = "";
$password = "";
$errors = array();

// If the register button is clicked
if (isset($_POST['register'])) {
  // Get the form data
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);

  // Ensure all required fields are filled
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if (empty($password_confirm)) {
    array_push($errors, "Confirm password is required");
  }

  // Check if the passwords match
  if ($password != $password_confirm) {
    array_push($errors, "Passwords do not match");
  }

  // Check if the username or email already exists
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // If there are no errors, insert the user into the database
  if (count($errors) == 0) {
    $password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
      echo "User registered successfully";
    } else {
      echo "Error registering user: " . mysqli_error($conn);
    }
  }
}

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
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./users/user_login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./user_register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  // Check if the form has been submitted

  ?>
  <section class="container p-3">
    <?php
    if (isset($error)) {
      echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="username">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirmed Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
      </div>
      <button type="submit" name="submit" value="Login" class="btn btn-primary">Submit</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      // Check if the passwords match
      if ($password != $confirm_password) {
        $error = "Passwords do not match.";
      } else {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the INSERT statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
          exit;
        } else {
          // An error occurred
          $error = "Error: " . $stmt->error;
        }
      }
    }
    ?>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>