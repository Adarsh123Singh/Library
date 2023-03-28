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
        <form method="POST">
            <div class="input-group-text mb-3 cont1">
                <input class="input-group-text" type="text" name="search" placeholder="Search Books" required>
                <button class="btn btn-dark" name="submit" type="submit">Search</button>
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
                    $numberPages = 3;

                    if (isset($_POST['submit'])) {
                        $search = $_POST['search'];

                        $sql = "SELECT * FROM library WHERE id like '%$search%' Or Bname like '%$search%' Or Aname like '%$search%'";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            $num = mysqli_num_rows($result);
                            if ($num > 0) {
                                ?><center>
                <table border='3' cellspacing='7' width=93%><?php
                                                                                            echo "<thead>
            <tr>
            <th width=5%>S.No.</th>
            <th width=5%>Images</th>
            <th width=10%>Book Name</th>
            <th width=10%>Book Title</th>
            <th width=10%>Author Name</th>
            <th width=10%>Book type</th>
            <th width=10%>Book Addition</th>
            <th width=20%>Description</th>
            <th width=18%>Operation</th>
        </tr>
        </thead>";
        while ($result = mysqli_fetch_assoc($result)) {
        $a = 1;
        echo "<tbody>
        <tr>
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

        <a href='view.php?id=$result[id]'><input type='submit' value='View' class='btn btn-info'> </a>
        </td>

        </tr>
        <tbody>";
                $a++;
                                }
                                ?></table><?php
                            } else {
                                echo "<h2 class = text-danger>Data Not Found</h2>";
                            }
                        }
                    }

                    if (isset($_GET['sort_alphabet'])) {
                        if ($_GET['sort_alphabet'] == 'a-z') {
                            $sort_option = "ASC";
                        } elseif ($_GET['sort_alphabet'] == 'z-a') {
                            $sort_option = "DESC";
                        }
                    }

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $count_query = "SELECT COUNT(*) as count FROM library";
                    $count_result = mysqli_query($con, $count_query);
                    $count_row = mysqli_fetch_assoc($count_result);
                    $total = $count_row['count'];

                    $num = ceil($total / $numberPages);

                    $startinglimit = ($page - 1) * $numberPages;

                    $sql = "SELECT * FROM library ORDER BY Bname $sort_option LIMIT $startinglimit,$numberPages";
                    $data = mysqli_query($con, $sql);
                    if ($total != 0) {
                        ?>
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
                    <th width=18%>Operation</th>
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
            <?php
                    for ($btn = 1; $btn <= $num; $btn++) {
                        echo '<button class="btn btn-dark mx-1 my-3"><a href="main.php?page=' . $btn . '&sort_alphabet=' . $sort_option . '" class="text-light">' . $btn . '</a></button>';
                    }
                    ?>
        </center>