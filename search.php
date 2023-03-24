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
        table {
            background-color: lightgrey;
            margin-top: 20px;
        }

        h2 {
            margin: 50px;
        }

        select {
            padding: 0 500px;
        }

        .con {
            align-items: inline-block;
        }

        .cont,
        .cont1 {
            margin: 20px 600px 20px 630px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Book Details</span>
            <a href="http://localhost:8080/lib/Edit_Details.php"><button type="button" class="btn btn-outline-success">ADD BOOK</button></a>
            <a href="http://localhost:8080/lib/Logout.php"><button type="button" class="btn btn-outline-primary">Log Out</button></a>
        </div>
    </nav>
    <div class="con">
        <form class="d-flex" method="GET" action="Search.php">
            <div class="input-group mb-3 cont1">
                <input class="input-group-text" type="search" name="search" placeholder="Search Books">
                <button class="btn btn-outline-success" name="search" type="submit">Search</button>
            </div>
        </form>
        <form class="d-flex" method="GET" action="">
            <div class="input-group mb-3 cont">
                <select name="sort_alphabet" class="input-group-text">
                    <option value="">--Select Option</option>
                    <option value="a-z" <?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == 'a-z');
                                        echo "selected"; ?>>A-Z</option>
                    <option value="z-a" <?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == 'z-a');
                                        echo "selected"; ?>>Z-A</option>
                </select>
                <button class="input-group-text btn btn-light">sort</button>
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
include('Details.php');
error_reporting(0);
$sort_option = "";

if (isset($_GET['sort_alphabet'])) {
    if ($_GET['sort_alphabet'] == 'a-z') {
        $sort_option = "Asc";
    } elseif ($_GET['sort_alphabet'] == 'z-a') {
        $sort_option = "Desc";
    }
}

$query = "SELECT * FROM library ORDER BY Bname $sort_option";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);


if ($total != 0) {
?>

    <h2 align='center'><mark>Table of Library</mark></h2>

    <center>
        <table border='3' cellspacing='7' width=93%>
            <tr>
                <th width=5%>S.No.</th>
                <th width=5%>Images</th>
                <th width=10%>Book Name</th>
                <th width=10%>Book Title</th>
                <th width=10%>Author Name</th>
                <th width=10%>Book type</th>
                <th width=10%>Book Addition</th>
                <th width=20%>Description</th>
                <th width=18%>Optimization</th>
            </tr>

        <?php
        $a = 1;
        while ($result = mysqli_fetch_assoc($data)) {
            echo "<tr>
                    <td>$a</td>
                    <td><img src='" . $result['img_upd'] . "' height='100px'></td>
                    <td>" . $result['Bname'] . "</td>
                    <td>" . $result['Btitle'] . "</td>
                    <td>" . $result['Aname'] . "</td>
                    <td>" . $result['Btype'] . "</td>
                    <td>" . $result['BAddition'] . "</td>
                    <td> " . $result['Description'] . "</td>

                    <td><a href='Switch.php?id=$result[id]'><input type='submit' value='Update' class='btn btn-success'></a>

                    <a href='delete.php?id=$result[id]'><input type='submit' value='Delete' class='btn btn-danger' onclick='return checkdelete()'></a>

                    <a href='view.php?id=$result[id]'><input type='submit' value='View' class='btn btn-info' </a>
                    </td>
                </tr>";
            $a++;
        }
    } else {
        echo "No Records Count";
    }
        ?>

        </table>
    </center>


    <script>
        function checkdelete() {
            return confirm('Are you sure do you want to delete it!');
        }
    </script>