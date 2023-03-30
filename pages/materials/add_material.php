<?php
// Include config file
require_once "../connection.php";

// retrieve class titles from classes table
$sql = "SELECT title FROM classes";
$result = $mysqli->query($sql);

// create options array for select input
$options = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($options, $row["title"]);
  }
}

// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // get form data and sanitize input
  $title = htmlspecialchars($_POST["title"]);
  $units = htmlspecialchars($_POST["units"]);
  $date = htmlspecialchars($_POST["date"]);
  $department = htmlspecialchars($_POST["department"]);
  $college = htmlspecialchars($_POST["college"]);
  $class_title = htmlspecialchars($_POST["class_title"]);

  // retrieve class_id from classes table
  $sql = "SELECT id FROM classes WHERE title = '$class_title'";
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  $class_id = $row["id"];

  // insert data into materials table
  $sql = "INSERT INTO materials (title,units, date, department, college, class_id) VALUES ('$title','$units', '$date', '$department', '$college', '$class_id')";

  if ($mysqli->query($sql) === TRUE) {
    echo ' <div class="alert alert-primary" role="alert">
          Material is registered successfully!
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
        <a class="nav-link" aria-current="page" href="materials.php?page=materials_list">قائمة المواد</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link active" href="materials.php?page=add_material">اضافة مادة</a>
      </li>
    </ul>
  </section>
  <div class="container p-5">
    <h2>تسجيل مادة جديد</h2>
    <form method="post" action="">
      <label for="title" class="form-label">عنوان المادة</label>
      <input class="form-control" type="text" name="title" required><br>
      <label for="units" class="form-label">الوحدات</label>
      <input class="form-control" type="number" name="units" required><br>
      <label for="date" class="form-label">التاريخ</label>
      <input class="form-control" type="date" name="date" required><br>
      <label for="department" class="form-label">القسم</label>
      <input class="form-control" type="text" name="department" required><br>
      <label for="college" class="form-label">الكلية</label>
      <input class="form-control" type="text" name="college" required><br>
      <label for="class_title" class="form-label">الصف</label>
      <select class="form-control" name="class_title" required>
        <?php foreach ($options as $option) { ?>
          <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php } ?>
      </select><br>
      <input type="submit" class="btn btn-primary" value="انشاء">
    </form>

  </div>
</body>

</html>