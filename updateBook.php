<?php include 'db_conn.php'; ?>
<?php


if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    $q = "SELECT bookTitle,author,isbn,quantity,img_loc FROM books WHERE id = '$id'";

    $r = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($r);
    $bookTitle = $row['bookTitle'];
    // $bookTitle = str_replace(" ", "", $bookTitle);
    // echo $bookTitle;
    $author = $row['author'];
    // echo $author;
    $isbn = $row['isbn'];
    $quantity = $row['quantity'];
    $img_name_db = $row['img_loc'];
    // echo "<pre>";
    // print_r($row);
    // echo $img_name_db;
    if (isset($_POST['updateBook'])) {
        $newbookTitle = $_POST['bookTitle'];
        $newbookTitle = str_replace("'", "''", $newbookTitle);
        $newauthor = $_POST['author'];
        $newauthor = str_replace("'", "''", $newauthor);
        $newisbn = $_POST['isbn'];
        $newquantity = $_POST['quantity'];
        
        // echo "bookTitle:" . $bookTitle;
        
        if (isset($_FILES['imgFileName'])) {
            $img_name = $_FILES['imgFileName']['name'];
            $img_size = $_FILES['imgFileName']['size'];
            $tmp_name = $_FILES['imgFileName']['tmp_name'];
            $error = $_FILES['imgFileName']['error'];

            if ($error === 0) {
                if ($img_size > 1000000) {
                    echo "<script>alert('File size too large');</script>";
                } else {
                    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                    echo $img_ext . "<br>";
                    $img_ext_lc = strtolower($img_ext);
                    $accepted_exts = ['jpg', 'png', 'jpeg'];
                    if (in_array($img_ext_lc, $accepted_exts)) {
                        echo "ACCEPTED" . '<br>';
                        echo str_ireplace(".", "", $img_name) . '<br>';
                        $img_name_db = trim(uniqid(str_ireplace('.' . $img_ext, "", $img_name)) . '.' . $img_ext_lc);
                        $img_name_db = str_replace("'", '', $img_name_db);
    
                        echo $img_name_db . '<br>';
                        $img_upload_path = 'assets/' . $img_name_db;
                        move_uploaded_file($tmp_name, $img_upload_path);
                    }
                }
    
            }
        }
        $query = $conn->prepare("UPDATE books set id = ?,bookTitle = ?, author = ?, isbn = ?, 
            quantity = ?, img_loc = ? WHERE id = '$id'");
        $query->bind_param('isssis',$id,$newbookTitle,$newauthor,$newisbn,$newquantity,$img_name_db);
        // $res = mysqli_query($conn, $query);
        $res = $query->execute();
        if ($res) {
            header("location:http://localhost/libraryMS/admin/adminView.php");
        }
    }
    ;

}

// 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/addBookStyle.css">
</head>

<body>
    <div class="container text-center">
        <!-- < echo '<div>'.$bookTitle.'</div>';?> -->
        
        <form class="form text-center" method="post" enctype="multipart/form-data">
            <h1 style="margin-bottom:100px">Update Book</h1>
            <div class="row ">
                <div class="col-4">
                    <label class="bookTitlelabel" for="bookTitle">Book Title - </label>
                </div>
                <div class="col-8 mb-2">
                    <input class="bookTitle" type="text" id="bookTitle" name="bookTitle" value="<?=($bookTitle ? htmlspecialchars($bookTitle) : ''); ?>"

                        required><br>
                </div>
            </div>
            <div class="row ">
                <div class="col-4">
                    <label class="authorlabel" style="width:100%" for="author">Author - </label>
                </div>
                <div class="col-8 mb-2 ">
                    <input class="author" type="text" name="author" value="<?=($author ? htmlspecialchars($author) : ''); ?>" required><br>
                </div>
            </div>
            <div class="row ">
                <div class="col-4">
                    <label class="isbnlabel" style="width:100%" for="isbn">ISBN - </label>
                </div>
                <div class="col-8 mb-2">
                    <input class="isbn" type="text" name="isbn" value=<?= $isbn ?> required><br>
                </div>
            </div>

            <div class="row ">
                <div class="col-4">
                    <label class="quantitylabel" for="quantity">Quantity - </label>
                </div>
                <div class="col-8 mb-2  ">
                    <input class="quantity " type="number" id="quantity" name="quantity" style="width:80%"
                        value=<?= $quantity ?> required><br>
                </div>
            </div>


            <div class="row ">
                <div class="col">
                    <label class="bookimagelabel" style="width:100%" for="quantity">Choose Book image - </label>
                </div>
                <div class="col-8 mb-2  ">
                    <input class="imgFileName" type="file" name="imgFileName"><br>
                </div>
            </div>
            <input class="submit" type="submit" name='updateBook' value='Update Book'>
        </form>
    </div>

</body>

</html>