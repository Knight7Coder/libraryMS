<?php
session_start();
include 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
  <title>LibraryMS</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand me-5 font" href="#">LIB</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="unsetSearch.php">Home</a>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['lname'])) {
              ?>

              <?php if ((isset($_SESSION['lrole'])) && ($_SESSION['lrole']) == "Admin") { ?>
                <a class="nav-link" name="logout" href="http://localhost/libraryMS/admin/adminView.php">My Panel</a>
              <?php } ?>
            <li class="nav-item">
              <a class="nav-link" name="logout" href="logout.php">Log out</a>

            </li>
          <?php } else {
              ?>
            <a class="nav-link" href="http://localhost/libraryMS/login.php">Log in</a>

            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/libraryMS/reg.php">Register</a>
            </li>
          <?php }
            ?>
        </ul>
        <?php if (isset($_SESSION['lname'])) {
          ?>
          <button class="me-4 btn btn-outline-danger ">Welcome,
            <?= $_SESSION['lname']; ?>
          </button>
        <?php } ?>
        <form class="d-flex" role="search" method=get>
          <input class="form-control me-2" type="search" placeholder="Search" name=term aria-label="Search" />
          <button class="btn btn-outline-success" name=search type="submit">
            Search
          </button>
        </form>

      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row g-4">
      <?php
      if (isset($_GET['search'])) {
        $_SESSION['search'] = $_GET['term'];
      }

      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      if (isset($_GET['search']) || isset($_SESSION['search'])) {

        $term = $_SESSION['search'];
        $limit = 3;
        $offset = ($page - 1) * $limit;
        $q = "SELECT * FROM books WHERE bookTitle = '$term' OR author = '$term' LIMIT $offset, $limit";
      } else {

        $limit = 3;
        $offset = ($page - 1) * $limit;
        $q = "SELECT * FROM books LIMIT $offset, $limit";

      }
      $res = mysqli_query($conn, $q);
      // echo '<div>' . mysqli_num_rows($res) . '</div>';
      if (mysqli_num_rows($res) > 0) {

        while ($out = mysqli_fetch_assoc($res)) {

          ?>

          <div class="d-flex align-items-center justify-content-center col-lg-4 col-sm-12 col-md-6 mt-5 ">
            <div class="card text-center d-flex justify-content-center" style="width: 60%; height: 100%;">
              <img src="assets/<?= $out['img_loc'] ?>" class="card-img-top" style="width:100%; height: 100%;"
                alt=<?= $out['bookTitle'] . "bookpic" ?> />
              <div class="card-body">

                <a href="#" class="card-title display-6 fs-6 fw-bolder fst-italic text-decoration-none"
                  style="color: brown;"><?= $out['bookTitle'] ?></a>
                <p class="card-text text-start pt-3">
                  Author:
                  <?= $out['author'] ?><br />ISBN :
                  <?= $out['isbn'] ?><br />
                  Quantity available:
                  <?= $out['quantity']; ?><br />
                </p>
                <a class="btn btn-primary me-3" name="update"
                  href="http://localhost/libraryMS/viewDetails.php?viewid=<?= $out['id'] ?>.">View Details</a>


              </div>
            </div>
          </div>



        <?php }
      } elseif (mysqli_num_rows($res) == 0 && isset($_GET['search'])) {

        echo "<h1>BOOK DOESN'T EXIST</h1>";
        exit;

      }
      ?>
    </div>
    <?php
    if (isset($_GET['search'])) {
      $seachedResults = "SELECT * FROM books WHERE bookTitle = '$term' OR author = '$term' ;";

      $searchQuery = mysqli_query($conn, $seachedResults);
      $noOfRecords = mysqli_num_rows($searchQuery);
    }

    $getAllRecords = "SELECT * FROM books";

    $result = mysqli_query($conn, $getAllRecords);
    $totalRows = mysqli_num_rows($result);

    if ($totalRows == 0) {
      echo "<h1 style='margin-top:100px;' >NO BOOKS ARE AVAILABLE IN THE LIBRARY</h1>";

    } else {
      if (isset($_GET['search'])) {
        // $totalsearch = mysqli_num_rows($res);
        $rows_per_page = ceil($noOfRecords / $limit);
        // echo '<div>' . $noOfRecords . $limit . $rows_per_page . 'r' . '</div>';
      } else {
        $rows_per_page = ceil($totalRows / $limit);
        // echo '<div>' . $rows_per_page . " 2" . '</div>';
      }
      echo ' <nav>
      <ul class="pagination justify-content-center mt-5">';
      if (($page - 1) > 0) {
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page - 1) . '">Previous</a></li>';
      }
      for ($i = 1; $i <= $rows_per_page; $i++) {
        if ($i == $page) {
          $active = "active";

        } else {
          $active = "";
        }
        echo '
           
              <li class="' . $active . ' page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
      }

      if ($rows_per_page > $page) {

        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page + 1) . '">Next</a></li>
              </ul>';
      }
    }
    ?>
    </nav>
  </div>

</body>

</html>