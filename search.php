<?php 
include 'db_conn.php';

    $res = mysqli_query($conn,$q);

    if (mysqli_num_rows($res) > 0) {
        while ($out = mysqli_fetch_assoc($res)) {

          ?>
          <div class="d-flex align-items-center justify-content-center col-lg-4 col-sm-12 col-md-6 ">
            <div class="card text-center d-flex justify-content-center" style="width: 60%; height: 100%;">
              <img src="assets/<?= $out['img_loc'] ?>" class="card-img-top" style="width:100%; height: 100%;"
                alt=<?= $out['bookTitle'] . "bookpic" ?> />
              <div class="card-body">
                <a href="#" class="card-title display-6 fs-6 fw-bolder fst-italic text-decoration-none"
                  style="color: brown;"><?php echo $out['bookTitle'] ?></a>
                <p class="card-text text-start pt-3">
                  Author:
                  <?= $out['author'] ?><br />ISBN :
                  <?= $out['isbn'] ?><br />
                  Quantity available:
                  <?= $out['quantity']; ?><br />
                </p>
                <a href="viewDetails.php" class="btn btn-primary">View Details</a>
              </div>
            </div>
          </div>

        <?php }
      } }?>
      <!-- <div class="d-flex align-items-center text-center  justify-content-center col-sm-12 col-md-6 col-lg-4">
          <div class="card" style="width: 15rem; height: max-content;">
            <img src="./assets/java.jpg" class="card-img-top" alt="java book" />
            <div class="card-body">
              <a href="#" class="card-title display-6 fs-6 fw-bolder  fst-italic text-decoration-none" style="color: purple;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"
                >JAVA</a
              >
              <p class="card-text text-start pt-3">
                Author: ANTHONY BRUN<br />ISBN : 12345<br />
                Quantity available: 5<br />
              </p>
              <a href="#" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center text-center justify-content-center col-sm-12 col-md-6 col-lg-4">
          <div class="card" style="width: 15rem; height: max-content;">
            <img src="./assets/java.jpg" class="card-img-top" alt="java book" />
            <div class="card-body">
              <a href="#" class="card-title display-6 fs-6 fw-bolder fst-italic text-decoration-none" style="color: purple;"
                >JAVA</a
              >
              <p class="card-text text-start pt-3">
                Author:JOSH THOMPSONS <br />ISBN : 1234567<br />
                Quantity available: 7<br />
              </p>
              <a href="#" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center text-center justify-content-center col-sm-12 col-md-6 col-lg-4">
          <div class="card" style="width: 15rem; height: max-content;">
            <img src="./assets/java.jpg" class="card-img-top" alt="java book" />
            <div class="card-body">
              <a href="#" class="card-title display-6 fs-6 fw-bolder fst-italic text-decoration-none" style="color: purple;"
                >JAVA</a
              >
              <p class="card-text text-start pt-3">
                Author:JOSH THOMPSONS <br />ISBN : 1234567<br />
                Quantity available: 7<br />
              </p>
              <a href="#" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center text-center justify-content-center col-sm-12 col-md-6 col-lg-4">
          <div class="card" style="width: 15rem; height: max-content;">
            <img src="./assets/java.jpg" class="card-img-top" alt="java book" />
            <div class="card-body">
              <a href="#" class="card-title display-6 fs-6 fw-bolder fst-italic text-decoration-none" style="color: purple;"
                >JAVA</a
              >
              <p class="card-text text-start pt-3">
                Author:JOSH THOMPSONS <br />ISBN : 1234567<br />
                Quantity available: 7<br />
              </p>
              <a href="#" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center text-center justify-content-center col-sm-12 col-md-6 col-lg-4">
          <div class="card" style="width: 15rem; height: max-content;">
            <img src="./assets/java.jpg" class="card-img-top" alt="java book" />
            <div class="card-body">
              <a href="#" class="card-title display-6 fs-6 fw-bolder fst-italic text-decoration-none" style="color: purple;"
                >JAVA</a
              >
              <p class="card-text text-start pt-3">
                Author:JOSH THOMPSONS <br />ISBN : 1234567<br />
                Quantity available: 7<br />
              </p>
              <a href="#" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center text-center justify-content-center col-sm-12 col-md-6 col-lg-4">
          <div class="card" style="width: 15rem; height: max-content;">
            <img src="./assets/java.jpg" class="card-img-top" alt="java book" />
            <div class="card-body">
              <a href="#" class="card-title display-6 fs-6 fw-bolder fst-italic text-decoration-none" style="color: purple;"
                >JAVA</a
              >
              <p class="card-text text-start pt-3">
                Author:JOSH THOMPSONS <br />ISBN : 1234567<br />
                Quantity available: 7<br />
              </p>
              <a href="#" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div> -->
    </div>
  </div>
</body>

</html>


