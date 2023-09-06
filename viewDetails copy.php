<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</head>

<body>
<div class="container p-0 mt-5">
  <h2 class="text-center" style="margin-top:80px;">BOOK DETAILS</h2>
  <a  class="btn btn-warning mb-3" href="http://localhost/libraryMS">Home</a>

  <?php include "db_conn.php";
  $query = "SELECT * FROM books";


  $res = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($res)) {
    $bookTitle = $row['bookTitle'];
    $author = $row['author'];
    $isbn = $row['isbn'];
    $quantity = $row['quantity'];
    $img_loc = $row['img_loc'];


    ?>
    
      
      <div class="card mb-3" style="">
        <div class="row g-2">
          <div class="col p-3 d-flex align-items-center justify-content-center" style="height:400px;">
            <img src="assets/<?= $img_loc ?>" class="card-img img-fluid"
              style="width:100%; height:100%;object-fit:contain;" alt="...">
          </div>
          <div class="col">
            <div class="card-body">
              <h5 class="card-title">
                <?= $bookTitle ?>
              </h5>
              <p class="card-text">Author :
                <?= $author ?> <br>
                ISBN :
                <?= $isbn ?><br>Quantity:
                <?= $quantity ?>
              </p>

              <a href="http://localhost/libraryMS/updateQuantity.php?returnid=<?= $row['id'] ?>."
                class="btn btn-primary img-fluid">RETURN </a>
              <a href="http://localhost/libraryMS/updateQuantity.php?borrowid=<?= $row['id'] ?>."
                class="btn btn-success img-fluid">BORROW </a>
              <?php if (($row['quantity'] == 0)) {
                echo ' 
     <div class="alert alert-danger d-flex align-items-center mt-3 p-4 " role="alert" style = "height:100%;">
     <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" style = "height:20px;">
       <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
     </svg>
     <div>
       No Books available to borrow
     </div>
   </div>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  </div>
</body>

</html>