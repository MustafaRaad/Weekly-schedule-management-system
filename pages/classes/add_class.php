<?php
// Include config file
require_once "../connection.php";

// Define variables and initialize with empty values
$title = $department = $college = $date = "";
$title_err = $department_err = $college_err = $date_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate username
  if (empty(trim($_POST["title"]))) {
    $title_err = "Please enter a title.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM classes WHERE title = ?";

    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_title);

      // Set parameters
      $param_title = trim($_POST["title"]);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // store result
        $stmt->store_result();
        $title = trim($_POST["title"]);
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  if (empty(trim($_POST["department"]))) {
    $department_err = "Please enter a department.";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["department"]))) {
    $department_err = "department can only contain letters, numbers, and underscores.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM classes WHERE department = ?";
    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_department);

      // Set parameters
      $param_department = trim($_POST["department"]);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // store result
        $stmt->store_result();
        $department = trim($_POST["department"]);
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }
  if (empty(trim($_POST["college"]))) {
    $college_err = "Please enter a college.";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["college"]))) {
    $college_err = "college can only contain letters, numbers, and underscores.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM classes WHERE college = ?";
    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_college);

      // Set parameters
      $param_college = trim($_POST["college"]);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // store result
        $stmt->store_result();
        $college = trim($_POST["college"]);
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  if (empty(trim($_POST["date"]))) {
    $date_err = "Please enter a date.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM classes WHERE date = ?";
    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param(
        "s",
        $param_date
      );

      // Set parameters
      $param_date = trim($_POST["date"]);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // store result
        $stmt->store_result();
        $date = trim($_POST["date"]);
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }


  // Check input errors before inserting in database
  if (empty($title_err) && empty($department_err) && empty($college_err) && empty($date_err)) {

    // Prepare an insert statement
    $sql = "INSERT INTO classes (title, department,college,date) VALUES (?, ?,?,?)";

    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("ssss", $param_title, $param_department, $param_college, $param_date);

      // Set parameters
      $param_title = $title;
      $param_department = $department;
      $param_college = $college;
      $param_date = $date;

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Redirect to login page
        echo ' <div class="alert alert-primary" role="alert">
          Class is registered successfully!
        </div>';
      } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
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
  <title>Add Class</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <section>
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item border rounded">
        <a class="nav-link" aria-current="page" href="classes.php?page=classes_list">قائمة الصفوف</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link active" href="classes.php?page=add_class">اضافة صف</a>
      </li>
    </ul>
  </section>
  <div class="container p-5">
    <h2>تسجيل صف جديد</h2>
    <form action="" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">عنوان الصف</label>
        <input type="text" name="title" id="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
        <span class="invalid-feedback"><?php echo $title_err; ?></span>
      </div>
      <div class="mb-3">
        <label for="department" class="form-label">القسم</label>
        <input type="text" name="department" id="department" class="form-control <?php echo (!empty($department_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $department; ?>">
        <span class="invalid-feedback"><?php echo $department_err; ?></span>
      </div>
      <div class="mb-3">
        <label for="college" class="form-label">الكلية</label>
        <input type="text" name="college" id="college" class="form-control <?php echo (!empty($college_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $college; ?>">
        <span class="invalid-feedback"><?php echo $college_err; ?></span>
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">التاريخ</label>
        <input type="date" name="date" id="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
        <span class="invalid-feedback"><?php echo $date_err; ?></span>
      </div>
      <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="انشاء">
      </div>
    </form>
  </div>
</body>

</html>