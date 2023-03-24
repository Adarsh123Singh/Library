<?php 
error_reporting(0);
include("Details.php"); 

$id = $_GET['id'];

$query = "SELECT * FROM library where id='$id'";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);

$result = mysqli_fetch_assoc($data);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>view Details</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="http://localhost:8080/lib/main.php"><input type="submit" value="Back" class="btn btn-light"></a>
            <span class="navbar mb-0 h1">View Details</span>
        </div>
    </nav>
    <div class="container">
        <form action="#" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                <label for="recipient-name" class="col-form-label"><b>Upload Image</b></label>
                <label for="recipient-name" class="col-form-label"><?php
                $Upd = $result['img_upd'];
               echo "<img src='$Upd'>";
                ?></label>
                    
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Book Name:</b></label>
                    <label for="recipient-name" class="col-form-label"><?php echo
                    $result['Bname'] ?></label>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Book Title:</b></label>
                    <label for="recipient-name" class="col-form-label"><?php echo $result['Btitle']; ?></label>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Author Name:</b></label>
                    <label for="recipient-name" class="col-form-label"><?php echo $result['Aname']; ?></label>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Book Type</b></label>
                    <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><?php 
                                if($result['Btype']=='Fiction'){
                                    echo "Fiction";
                                }
                                else{
                                    echo "Non-Fiction";
                                }
                            ?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Book Addition</b></label>
                    <label for="recipient-name" class="col-form-label"><?php echo $result['BAddition']; ?></label>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Description/About</b></label>
                    <label for="recipient-name" class="col-form-label"><?php echo $result['Description']; ?></label>
                   
                </div>
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
    if(isset($_POST['update']))
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

    $query = "UPDATE library SET img_upd='$folder', Bname='$Bname',Btitle='$Btitle',Aname='$Aname',Btype='$Btype',BAddition='$Baddition',Description='$Description' WHERE id='$id'";
    $data = mysqli_query($con,$query);
    if ($data) {
        echo "<script>alert('Record Updated')</script>";
        ?>
            <meta http-equiv = "refresh" content = "0; url = http://localhost:8080/lib/main.php" />
        <?php
    } else {
        echo "Something Wrong";
    }
}
    else{
        echo "<script>alert('First Fill Full Book Details')</script>";
    }
}
?>