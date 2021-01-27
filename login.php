<?php
session_start();
 if (isset($_SESSION["username"])){
  header("Location:curd.php");
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user=$_POST['username']; 
   $mypassword = ($_POST['password']);
    $server="localhost";
$database="login";
$username="root";
$password="";
$conn=mysqli_connect($server,$username,$password,$database);
$sql = "SELECT * FROM `user` WHERE `Username`= '$user'";
$RESULT= mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($RESULT);
  if ($numrows > 0){
    while($row = mysqli_fetch_assoc($RESULT))
    { if (password_verify($mypassword,$row['Password'] )){
      session_start();
  
      $_SESSION["username"] = $user;
      $_SESSION["login_time_stamp"] = time();   
      header("Location:curd.php");
    }
    else{
      echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <center><strong>invaild password ! </strong> </center>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";

    }
    }
  }else {
    echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <center><strong>invaild  username ! </strong> </center>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  
      
  }
}



?>


<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="sty.css" >
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Login</title>
  </head>
 <body style="background-color: rgb(204, 195, 155) ;">

  <div class="contanior " >
  <form action="login.php" method="post" enctype="application/x-www-form-urlencoded">
         <TR>
        <br><th class="heading" >Username</th>
        </TR><br>
<tr>
<td ><input type="text"name="username" class="from" required placeholder="Username"></td></tr><br>
<tr> <th class="heading"> Password</th><br>
</tr>
<tr><td><input type="password"name="password" class="from" required placeholder='Password'></td></tr><br>
<tr> <td> <input type="submit" class="btn btn-primary mt-3" id="submit" value="Login"></button></td></tr>
<tr> <td> <input type="button" onclick="location.href='signup.php';" class="btn btn-primary mt-3" id="signup" value="Sign Up"></button><pre></td></tr>
</form></div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <?php include 'flooter.php'; ?>
  </body>
</html>
