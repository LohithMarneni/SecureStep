<?php
    $showalert=false;
    $showerror=false;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "components/_dbconnect.php";
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    $existsql="select * from users where name='$username';";
    $resultexist=mysqli_query($conn,$existsql);
    $numrows=mysqli_num_rows($resultexist);
    if($numrows> 0){
      $showerror="Username already existed try another one!!";
    }
    else{
      if(($password==$cpassword)){
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` (`name`, `password`) VALUES ('$username', '$hash');";
        $result=mysqli_query($conn,$sql);
        if($result){
          $showalert=true;
        }
      }
      else{
        $showerror="password doesn't match";
      }
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- caption Access. Secure. Simplify.-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SecureStep-SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require "components/_nav.php"
    ?>
    <?php
   if($showalert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created now You can login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
   }
   if($showerror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$showerror.'... Failed to create account!!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
   }
?>
    <div class="container my-4">
        <h2 class="text-center">SignUp to SecureStep</h2>
        <form action="/php projects/securestep project/signup.php" method="post">
  <div class="mb-3 ">
    <label for="username" class="form-label">Username</label>
    <input type="text" maxlength="20" class="form-control" id="username" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password"  maxlength="128" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3 ">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="cpassword" id="cpassword">
    <div id="cpassword" class="form-text">Make sure to enter the same password</div>
  </div>
  <button type="submit" class="btn btn-primary">SignUp</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>