<?php
include("Details.php");

$id = $_GET['id'];

$query = "DELETE FROM library where id ='$id'";
$data = mysqli_query($con,$query);

if($data){
    echo "<script>alert('Record Deleted')</script>";
    ?>
    <meta http-equiv = "refresh" content = "0; url = http://localhost:8080/lib/main.php"/>
    <?php
}
else{
    echo "Failed to Delete";
}

?>