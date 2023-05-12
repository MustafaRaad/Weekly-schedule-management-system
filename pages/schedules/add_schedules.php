<?php
// Include config file
require_once "../connection.php";

// retrieve teacher names from teachers table
$sql = "SELECT name FROM teachers";
$result = $mysqli->query($sql);

// create options array for select input
$teacherOptions = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($teacherOptions, $row["name"]);
  }
}

// retrieve material titles from schedules table
$sql = "SELECT title FROM materials";
$result = $mysqli->query($sql);

// create options array for select input
$materialOptions = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($materialOptions, $row["title"]);
  }
}

// retrieve class titles from classes table
$sql = "SELECT title FROM classes";
$result = $mysqli->query($sql);

// create options array for select input
$classOptions = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($classOptions, $row["title"]);
  }
}

// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // get form data and sanitize input
  $teacherName = htmlspecialchars($_POST["teacher_name"]);
  $materialTitle = htmlspecialchars($_POST["material_title"]);
  $classTitle = htmlspecialchars($_POST["class_title"]);
  $timeFrom = htmlspecialchars($_POST["time_from"]);
  $timeTo = htmlspecialchars($_POST["time_to"]);

  // retrieve teacher_id from teachers table
  $sql = "SELECT id FROM teachers WHERE name = '$teacherName'";
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  $teacherId = $row["id"];

  // retrieve material_id from materials table
  $sql = "SELECT id FROM materials WHERE title = '$materialTitle'";
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  $materialId = $row["id"];

  // retrieve class_id from classes table
  $sql = "SELECT id FROM classes WHERE title = '$classTitle'";
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  $classId = $row["id"];

  // insert data into schedules table
  $sql = "INSERT INTO schedules (teacher_id, material_id, class_id, time_from, time_to)
          VALUES ('$teacherId', '$materialId', '$classId', '$timeFrom', '$timeTo')";

  if ($mysqli->query($sql) === TRUE) {
    echo ' <div class="alert alert-primary" role="alert">
          Schedule record is created successfully!
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
  <title>Create Schedule Record</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <section>
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item border rounded">
        <a class="nav-link" aria-current="page" href="schedules.php?page=schedules_list">قائمة الجداول</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link active" href="schedules.php?page=add_schedules">اضافة جدول</a>
      </li>
    </ul>
  </section>
  <div class="container p-5">
    <h2>اضافة جدول</h2>
    <form method="post" action="">
      <label for="teacher_name" class="form-label">اسم المدرس</label>
      <select class="form-control" name="teacher_name" required>
        <?php foreach ($teacherOptions as $option) { ?>
          <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php } ?>
      </select><br>

      <label for="material_title" class="form-label">عنوان المادة</label>
      <select class="form-control" name="material_title" required>
        <?php foreach ($materialOptions as $option) { ?>
          <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php } ?>
      </select><br>

      <label for="class_title" class="form-label">عنوان الصف</label>
      <select class="form-control" name="class_title" required>
        <?php foreach ($classOptions as $option) { ?>
          <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php } ?>
      </select><br>

      <label for="time_from" class="form-label">الوقت من </label>
      <input class="form-control" type="time" name="time_from" required><br>

      <label for="time_to" class="form-label">الوقت الى</label>
      <input class="form-control" type="time" name="time_to" required><br>

      <input type="submit" class="btn btn-primary" value="Create">
    </form>
  </div>
</body>

</html>