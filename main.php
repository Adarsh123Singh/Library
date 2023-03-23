<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Book Details</title>
    <style>
        body{
            background: lightblue;
        }
        table{
            background-color: white;
            margin-top: 20px;
        }
        h2{
            margin: 50px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Book Details</span>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>

            </form>
            <a href="http://localhost:8080/lib/Edit_Details.php"><button type="button" class="btn btn-outline-success">ADD BOOK</button></a>
            <a href="http://localhost:8080/lib/Logout.php"><button type="button" class="btn btn-outline-primary">Log Out</button></a>
        </div>
    </nav>

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
    include('Details.php');
    error_reporting(0);
    $query = "SELECT * FROM library";
    $data = mysqli_query($con, $query);
    $total = mysqli_num_rows($data);

    
    if($total != 0)
    {
        ?>

        <h2 align='center'><mark>Table of Library</mark></h2>

        <center><table border='3' cellspacing='7' width=95%>
            <tr>
            <th width=5%>S.No.</th>
            <th width=5%>Images</th>
            <th width=10%>Book Name</th>
            <th width=10%>Book Title</th>
            <th width=10%>Author Name</th>
            <th width=10%>Book type</th>
            <th width=10%>Book Addition</th>
            <th width=20%>Description</th>
            <th width=20%>Optimization</th>
            </tr>

        <?php
        $a=1;
        while($result = mysqli_fetch_assoc($data)){
            echo "<tr>
                    <td>$a</td>
                    <td><img src='".$result['img_upd']."' height='100px'></td>
                    <td>".$result['Bname']."</td>
                    <td>".$result['Btitle']."</td>
                    <td>".$result['Aname']."</td>
                    <td>".$result['Btype']."</td>
                    <td>".$result['BAddition']."</td>
                    <td> ".$result['Description']."</td>

                    <td><a href='Switch.php?id=$result[id]'><input type='submit' value='Update' class='btn btn-success'></a>

                    <a href='delete.php?id=$result[id]'><input type='submit' value='Delete' class='btn btn-danger' onclick='return checkdelete()'></a></td>
                </tr>";
                $a++;
        }
    }
    else{
        echo "No Records Count";
    }
?>

</table>
</center>


<script>
    function checkdelete(){
        return confirm('Are you sure do you want to delete it!');
    }
</script>