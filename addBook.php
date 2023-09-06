<?php include 'db_conn.php';
session_start();
if (isset($_SESSION['lname']) && isset($_SESSION['lrole']) && ($_SESSION['lrole'] == 'Admin')) {


    if (isset($_POST['addBook']) && isset($_FILES['imgFileName'])) {

        $bookTitle = $_POST['bookTitle'];
        $bookTitle = str_replace("'", "''", $bookTitle);
        $author = $_POST['author'];
        $author = str_replace("'", "''", $author);
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];
        $query = '';


        echo '<pre>';
        print_r($_FILES['imgFileName']);
        echo '<pre>';

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

            $query = $conn->prepare("INSERT INTO books(bookTitle, author, isbn, quantity,img_loc) VALUES (?,?,?,?,?)");
            $query->bind_param('sssis', $bookTitle, $author, $isbn, $quantity, $img_name_db);
            $query->execute();


        }
    }
} elseif ($_SESSION['lrole'] != 'Admin') {
    header("location:http://localhost/libraryMS");
}
;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/addBookStyle.css">
</head>

<body>
    <div class="container ">
        <a class="btn btn-primary mb-3" href="http://localhost/libraryMS/">Home</a>



        <form class="form text-center" method="post" enctype="multipart/form-data">
            <h1 style="margin:50px 0px 80px 0px">Add Book</h1>
            <div class="row ">
                <div class="col-4">
                    <label class="bookTitlelabel" for="bookTitle">Book Title - </label>
                </div>
                <div class="col-8 mb-2">
                    <input class="bookTitle" type="text" id="bookTitle" name="bookTitle" required><br>
                </div>
            </div>
            <div class="row ">
                <div class="col-4">
                    <label class="authorlabel" style="width:100%" for="author">Author - </label>
                </div>
                <div class="col-8 mb-2 ">
                    <input class="author" type="text" name="author" value='' required><br>
                </div>
            </div>
            <div class="row ">
                <div class="col-4">
                    <label class="isbnlabel" style="width:100%" for="isbn">ISBN - </label>
                </div>
                <div class="col-8 mb-2">
                    <input class="isbn" type="text" name="isbn" value='' required><br>
                </div>
            </div>

            <div class="row ">
                <div class="col-4">
                    <label class="quantitylabel" for="quantity">Quantity - </label>
                </div>
                <div class="col-8 mb-2  ">
                    <input class="quantity " type="number" id="quantity" name="quantity" style="width:80%" value=''
                        required><br>
                </div>
            </div>


            <div class="row ">
                <div class="col">
                    <label class="bookimagelabel" style="width:100%" for="quantity">Choose Book image - </label>
                </div>
                <div class="col-8 mb-2">
                    <input class="imgFileName" type="file" name="imgFileName" required><br>
                </div>
            </div>
            <input class="submit" type="submit" name='addBook' value='Add Book'>
        </form>
    </div>

</body>

</html>