<?php
// Include config file
require_once "../connection.php";

// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // get form data and sanitize input
  $title = htmlspecialchars($_POST["title"]);
  $name = htmlspecialchars($_POST["name"]);
  $department = htmlspecialchars($_POST["department"]);
  $college = htmlspecialchars($_POST["college"]);

  // insert data into materials table
  $sql = "INSERT INTO teachers (title,name, department, college) VALUES ('$title','$name', '$department', '$college')";

  if ($mysqli->query($sql) === TRUE) {
    echo ' <div class="alert alert-primary" role="alert">
          Teacher is registered successfully!
        </div>';
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
}
// Close connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Material</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <section>
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item border rounded">
        <a class="nav-link" aria-current="page" href="admin.php?page=users_list">قائمة المستخدمين</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link " href="admin.php?page=add_user">اضافة مستخدم</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link" aria-current="page" href="admin.php?page=teachers_list">قائمة المدرسين</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link active" href="admin.php?page=add_teachers">اضافة مدرس</a>
      </li>
    </ul>
  </section>
  <div class="container p-5">
    <h2>تسجيل مدرس جديد</h2>
    <form method="post" action="">
      <div class="row">
        <div class="col-2">
          <label for="title" class="form-label">العنوان العلمي</label>
          <select class="form-control" type="text" name="title" required>
            <option value="Mr.">Mr.</option>
            <option value="Mrs.">Mrs.</option>
            <option value="Dr.">Dr.</option>
            <option value="Prof.">Prof.</option>
          </select>
        </div>
        <div class="col-10">
          <label for="units" class="form-label">الاسم</label>
          <input class="form-control" name="name" required><br>
        </div>
      </div>
      <label for="department" class="form-label">القسم</label>
      <input class="form-control" type="text" name="department" required><br>
      <label for="college" class="form-label">الكلية</label>
      <input class="form-control" type="text" name="college" required><br>
      <input type="submit" class="btn btn-primary" value="انشاء">
    </form>

  </div>
</body>

</html>