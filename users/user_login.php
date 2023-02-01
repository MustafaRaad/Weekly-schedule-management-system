  <?php
  // Check if the form has been submitted
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SELECT statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record was found
    if ($result->num_rows > 0) {
      // Store the user data in a session variable
      $_SESSION['logged_in'] = true;
      $_SESSION['username'] = $username;

      // Redirect to the homepage
      header("Location: ./pages/home.php");
      exit();
    } else {
      // Login was not successful, show an error message
      $error = "Invalid username or password.";
    }
  }
  ?>
  <section class="container p-3 vh-100 d-flex align-items-center">
    <?php if (isset($error)) { ?>
      <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <form action="" method="post" class="w-100">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" name="submit" value="Login" class="btn btn-primary">Submit</button>
    </form>
  </section>