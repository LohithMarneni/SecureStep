<?php
    $login=false;
    $showpasserror=false;
    // $showexisterror=false;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
      include "components/_dbconnect.php";
    $username=$_POST["username"];
    $password=$_POST["password"];
    $exist=false;
      // $sql="SELECT * FROM users WHERE name='$username' and password='$password'";
      $sql="SELECT * FROM users WHERE name='$username'";
      $result=mysqli_query($conn,$sql);
      $rows=mysqli_num_rows($result);
      if($rows==1){
        while($row=mysqli_fetch_assoc($result)){
          if(password_verify($password,$row["password"])){
            $login=true;
            session_start();
            $_SESSION["loggedin"]=true;
            $_SESSION["username"]=$username;
            header("location:welcome.php");
          }
          else{
            $showpasserror="Invalid Credentials";
          }
        }
      }
    else{
      $showpasserror="Invalid Credentials";
    }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- caption Access. Secure. Simplify.-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SecureStep-Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require "components/_nav.php"
    ?>
    <?php
   if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You had succesfully logged in
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
   }
   if($showpasserror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$showpasserror.'! Your Credentials are wrong
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
   }
?>
    <div class="container my-4">
        <h2 class="text-center">Login to SecureStep</h2>
        <form action="/php projects/securestep project/login.php" method="post">
  <div class="mb-3 ">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>