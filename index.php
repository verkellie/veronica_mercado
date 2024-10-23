<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>CRUD Application</title>
  <script>
    function printPage() {
      window.print();
    }
  </script>
  <style>
    body {
      background-color: #f0f4f8; /* Soft background */
      font-family: Arial, sans-serif;
    }
    nav {
      background-color: #007bff; /* Primary color */
      color: white;
      padding: 1rem;
      text-align: center;
    }
    .alert {
      margin-top: 20px;
    }
    .btn-custom {
      background-color: #28a745; /* Green for Add New */
      border: none;
      color: white;
      margin-right: 10px;
    }
    .btn-custom:hover {
      background-color: #218838; /* Darker green on hover */
    }
    .btn-print {
      background-color: #ffc107; /* Yellow for Print */
      border: none;
      color: black;
    }
    .btn-print:hover {
      background-color: #e0a800; /* Darker yellow on hover */
    }
    .table {
      margin-top: 20px;
      background-color: #ffffff; /* White table background */
      border-radius: 0.5rem; /* Rounded corners */
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }
    .table-dark {
      background-color: #343a40; /* Dark table header */
      color: white;
    }
    .table-hover tbody tr:hover {
      background-color: #e9ecef; /* Light grey on hover */
    }
    .input-group {
      margin-bottom: 20px;
    }
    .input-group input {
      border-radius: 0.5rem 0 0 0.5rem; /* Rounded left corners */
      border: 1px solid #ced4da; /* Border color */
    }
    .input-group button {
      border-radius: 0 0.5rem 0.5rem 0; /* Rounded right corners */
      background-color: #007bff; /* Blue button */
      color: white;
    }
    .input-group button:hover {
      background-color: #0056b3; /* Darker blue on hover */
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <h2>CRUD APPLICATION</h2>
  </nav>

  <div class="container mt-4">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    
    <div class="mb-3">
      <a href="register.php" class="btn btn-custom">Add New</a>
      <button class="btn btn-print" onclick="printPage()">Print</button>
    </div>

    <div class="mb-3">
      <form method="GET" action="">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search by Name" aria-label="Search by Name">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
      </form>
    </div>

    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Gender</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
        $sql = "SELECT * FROM cruddd WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["first_name"] ?></td>
            <td><?php echo $row["last_name"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["gender"] ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
