<!-- check if data is comming ore not -->
<?php
   if(isset(($_POST['upload']))){
    // echo "data is comming";
    // // var_dump($_POST ,);// or printr
    // echo "<pre>";
    // print_r($_FILES['img']);
    // echo "</pre>";
    //from temp loaction
    // to permanent loaction
   
    // DB connection open
    $conn = mysqli_connect("localhost","root","","ecom4_db") or die("Couldn't connect to db");
     // always filter the incomming data 
     $name = mysqli_real_escape_string($conn, $_POST["name"]);
     $img_name = mysqli_real_escape_string($conn, $_FILES['img']['name']);
      $source = $_FILES['img']['tmp_name'];
    $target = "./uploads/".$img_name ;
    move_uploaded_file("$source","$target");
    // build the query
    $sql = "INSERT INTO user_tbl(`fname`,`photo`) VALUES('$name','$img_name')";
    // 3 execute the query
    $result=mysqli_query($conn, $sql) or die("Couldn't execute");
    // 4 Show the results
      echo"File uploaded successfully";
    // DB connection close
    mysqli_close( $conn );
   }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  echo $_SERVER['PHP_SELF'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>File uploading without ajax</h1>
    <form class="w-50 offset-3 mt-3
    " method="POST" enctype="multipart/form-data" action="<?php  echo $_SERVER['PHP_SELF'] ?>
    ">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">

        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="img">
        </div>

        <button type="submit" class="btn btn-primary" name="upload" value="upload">Upload</button>
    </form>
</body>

</html>