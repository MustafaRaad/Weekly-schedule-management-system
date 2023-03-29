<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users list</title>
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
  <section>
    <ul class="nav nav-pills nav-fill p-4">
      <li class="nav-item border rounded">
        <a class="nav-link active" aria-current="page" href="teachers.php?page=teachers_list">قائمة الصفوف</a>
      </li>
      <li class="nav-item border rounded">
        <a class="nav-link " href="teachers.php?page=add_teachers">اضافة صف</a>
      </li>
    </ul>
  </section>
  <section class="container bg-body-tertiary p-3">
    <?php
    if (isset($error)) {
      echo "<p style='color:red;'>$error</p>";
    } else {
      $sql = "SELECT * FROM users";
      // Execute the query
      $result = mysqli_query($mysqli, $sql);
    }
    if (mysqli_num_rows($result) > 0) {
    ?>
      <table class="table">
        <thead>
          <th scope="col">المعرف</th>
          <th scope="col">اسم المستخدم</th>
          <th scope="col">وقت الانشاء</th>
        </thead>
        <tbody>

          <?php // Write the SQL query
          // Check if the query was successful
          // Fetch the results into an array
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><th scope='row'>" . $row["id"] . "</th>" . "<td scope='row'>" . $row["username"] . "</td>" . "<td scope='row'>" . $row["created_at"] . "</td>";
          }
          ?>

        </tbody>
      </table>
    <?php
    } else {
      echo "No users found.";
    }
    // Close the connection
    mysqli_close($mysqli);
    ?>
  </section>

</body>

</html>