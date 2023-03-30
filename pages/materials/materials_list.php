<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Materials list</title>
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
  <section>
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item border rounded">
        <a class="nav-link active" aria-current="page" href="materials.php?page=materials_list">قائمة المواد</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link " href="materials.php?page=add_material">اضافة مادة</a>
      </li>
    </ul>
  </section>
  <section class="container bg-body-tertiary p-3">
    <?php
    if (isset($error)) {
      echo "<p style='color:red;'>$error</p>";
    } else {
      $sql = "SELECT * FROM materials";
      // Execute the query
      $result = mysqli_query($mysqli, $sql);
    }
    if (mysqli_num_rows($result) > 0) {
    ?>
      <table class="table">
        <thead>
          <th scope="col">العنوان</th>
          <th scope="col">الكلية</th>
          <th scope="col">القسم</th>
          <th scope="col">التاريخ</th>
        </thead>
        <tbody>

          <?php // Write the SQL query
          // Check if the query was successful
          // Fetch the results into an array
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><th scope='row'>" . $row["title"] . "</th>" . "<td scope='row'>" . $row["college"] . "</td>" . "<td scope='row'>" . $row["department"] . "</td>" . "<td scope='row'>" . $row["date"] . "</td>";
          }
          ?>

        </tbody>
      </table>
    <?php
    } else {
      echo "No materials found.";
    }
    // Close the connection
    mysqli_close($mysqli);
    ?>
  </section>

</body>

</html>