<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Schedule list</title>
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
  <section>
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item border rounded">
        <a class="nav-link active" aria-current="page" href="schedules.php?page=schedules_list">قائمة الجداول</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link " href="schedules.php?page=add_schedules">اضافة جدول</a>
      </li>
    </ul>
  </section>
  <section class="container bg-body-tertiary p-3">
    <?php
    if (isset($error)) {
      echo "<p style='color:red;'>$error</p>";
    } else {
      $sql = "SELECT s.id, t.name  AS teacher_name,t.title  AS teacher_title, m.title AS material_title, c.title AS class_title, s.time_from, s.time_to 
            FROM schedules AS s
            INNER JOIN teachers AS t ON s.teacher_id = t.id
            INNER JOIN materials AS m ON s.material_id = m.id
            INNER JOIN classes AS c ON s.class_id = c.id";
      // Execute the query
      $result = mysqli_query($mysqli, $sql);

    }
    if (mysqli_num_rows($result) > 0) {
    ?>
      <table class="table">
        <thead>
          <th scope="col">المدرس</th>
          <th scope="col">المادة</th>
          <th scope="col">الصف</th>
          <th scope="col">الوقت من </th>
          <th scope="col">الوقت الى</th>
        </thead>
        <tbody>

          <?php // Write the SQL query
          // Check if the query was successful
          // Fetch the results into an array
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><th scope='row'>" . $row["teacher_title"] . $row["teacher_name"] . "</th>" . "<td scope='row'>" . $row["material_title"] . "</td>" . "<td scope='row'>" . $row["class_title"] . "</td>" . "<td scope='row'>" . $row["time_from"] . "</td>" . "<td scope='row'>" . $row["time_to"] . "</td>";
          }
          ?>

        </tbody>
      </table>
    <?php
    } else {
      echo "No schedules found.";
    }
    // Close the connection
    mysqli_close($mysqli);
    ?>
  </section>

</body>

</html>