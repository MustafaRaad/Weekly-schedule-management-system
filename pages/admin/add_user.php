<?php
// Include config file
require_once "../connection.php";

// Define variables and initialize with empty values
$username = $user_type = $password = $confirm_password = "";
$username_err = $user_type_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate username
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
    $username_err = "Username can only contain letters, numbers, and underscores.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE username = ?";

    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_username);

      // Set parameters
      $param_username = trim($_POST["username"]);
      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // store result
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $username_err = "This username is already taken.";
        } else {
          $username = trim($_POST["username"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }
  // Validate password
  if (empty(trim($_POST["user_type"]))) {
    $user_type_err = "Please enter a user type.";
  } else {
    $user_type = trim($_POST["user_type"]);
  }

  // Check input errors before inserting in database
  if (empty($username_err) && empty($user_type_err) && empty($password_err) && empty($confirm_password_err)) {
    // Generate a unique user_type value
    $user_type = trim($_POST["user_type"]) . '_' . uniqid();
    echo $user_type;
    // Prepare an insert statement
    $sql = "INSERT INTO users (username, user_type, password) VALUES (?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param(
        "sss",
        $param_username,
        $param_user_type,
        $param_password
      );

      // Set parameters
      $param_username = $username;
      $param_user_type = $user_type;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Redirect to login page
        header("location: /wsms/pages/users/user_login.php");
        exit();
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }


  // Close connection
  $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <section>
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item border rounded">
        <a class="nav-link" aria-current="page" href="admin.php?page=users_list">قائمة المستخدمين</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link active" href="admin.php?page=add_user">اضافة مستخدم</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link" aria-current="page" href="admin.php?page=teachers_list">قائمة المدرسين</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link" href="admin.php?page=add_teachers">اضافة مدرس</a>
      </li>
    </ul>
  </section>
  <div class="container p-5">
    <h2>تسجيل مستخدم جديد</h2>
    <p>يرجى ملء هذا النموذج لإنشاء حساب.</p>
    <form action="" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">اسم المستخدم</label>
        <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
        <span class="invalid-feedback"><?php echo $username_err; ?></span>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">كلمة المرور</label>
        <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">تأكيد كلمة المرور</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
      </div>
      <label class="form-label">نوع المستخدم</label>
      <select class="form-select mb-3" aria-label="User Type" name="user_type" id="user_type">
        <option value="1">ادمن</option>
        <option value="2">مدرس</option>
        <option value="3">طالب</option>
      </select>
      <span class="invalid-feedback"><?php echo $user_type_err; ?></span>
      <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="انشاء">
      </div>
    </form>
  </div>
</body>

</html>