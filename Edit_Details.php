<?php 
include("Details.php"); 
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Edit Details</title>
    <link rel="stylesheet" href="style4.css">
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="http://localhost:8080/lib/main.php"><input type="submit" value="Back" class="btn btn-light"></a>
            <span class="navbar mb-0 h1">Enter Book Details</span>
        </div>
    </nav>
    <div class="container">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Upload Image</label>
                <input type="file" name="uploadfile">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Book Name</label>
                    <input type="text" class="form-control" name="Bname" >
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Book Title</label>
                    <input type="text" class="form-control" name="Btitle">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Author Name</label>
                    <input type="text" class="form-control" name="Aname">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Book Type</label>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="Btype">
                            <option selected></option>
                            <option value="Fiction">Fiction</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Book Addition</label>
                    <input type="text" class="form-control" name="Baddition">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description/About</label>
                    <textarea class="form-control" name="Description"></textarea>
                </div>
                <input type="submit" value="Save" class="btn btn-primary" name="submit">
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>

<?php
    if(isset($_POST['submit']))
    {

        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "images/".$filename;  
        move_uploaded_file($tempname,$folder);

        $Bname       = $_POST['Bname'];
        $Btitle      = $_POST['Btitle'];
        $Aname       = $_POST['Aname'];
        $Btype       = $_POST['Btype'];
        $Baddition   = $_POST['Baddition'];
        $Description = $_POST['Description'];



if ($Bname !="" && $Btitle !="" && $Aname !=="" && $Btype !="" && $Baddition !="" && $Description !="") {
    $query = "INSERT INTO library (img_upd, Bname, Btitle, Aname, Btype, BAddition, Description) VALUES ('$folder','$Bname', '$Btitle', '$Aname', '$Btype', '$Baddition', '$Description')";
    $data = mysqli_query($con, $query);
    if ($data) {
        echo "Data inserted into Database";
    } else {
        echo "Something Wrong";
    }
}
    else{
        echo "<script>alert('First Fill Full Book Details')</script>";
    }
}
?>