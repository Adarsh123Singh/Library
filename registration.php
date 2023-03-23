<?php
include ('update_design.php');
if ($_SERVER['REQUEST_METHOD']=='POST'){
 
  $Fname = $_POST['Fname'];
  $Lname = $_POST['Lname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * from form where email='$email'";

  $result = mysqli_query($conn,$sql);
  if($result){
    $num = mysqli_num_rows($result);
    if($num>0){
      ?>
        <script>
          alert ("User Already Exists");
        </script>
        <?php
    }
    else{
        $sql = "INSERT INTO form(Fname,Lname,email,password) VALUES('$Fname','$Lname','$email','$password')";
       $result = mysqli_query($conn,$sql);
       if($result){
        ?>
        <script>
          alert ("signup successfully");
        </script>
        <?php
    
  }
  else{
      echo "Something Wrong";
  }
    }
  }
}
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Registration for Book Details</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Registration For Library</span>
    <a href="http://localhost:8080/lib/login.php"><input type="submit" value="Log in" class="btn btn-primary"></a>
  </div>
</nav>
  <div class="container">
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Registration Form</a>
      </div>
    </nav>
    <form action="#" method="POST">
      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">First Name</label>
        <input type="text" class="input" id="recipient-name" name="Fname" placeholder="Enter First Name" required>
      </div>
      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Last Name</label>
        <input type="text" class="input" id="recipient-name" name="Lname" placeholder="Enter Last Name" required>
      </div>
      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">email</label>
        <input type="text" class="input" id="recipient-name" name="email" placeholder="Enter email" required>
      </div>
      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Password</label>
        <input type="password" class="input" id="recipient-name" name="password" required>
      </div>
      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Confirm Password</label>
        <input type="password" class="input" id="recipient-name" name="confirm_password" required>
      </div>
      <div class="terms">
        <label class="check">
          <input type="checkbox" required>
        </label>
        <p>I want to register in Library</p>
        <a href="#"><input type="submit" value="Submit" class="btn-primary two" name="Submit"></a>
      </div>
      </a>
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

