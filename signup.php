<?php

session_start();
 if (isset($_SESSION["username"])){
  header("Location:curd.php");
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user=$_POST['username'];

     $pass=$_POST['password'];
    $cpass=$_POST['cpassword']; 
    $server="localhost";
    $database="login";
    $username="root";
    $password="";
    
    $conn=mysqli_connect($server,$username,$password,$database);
 $sql = "SELECT * FROM `user` WHERE `Username`='$user'";
$result=mysqli_query($conn,$sql);
$r1=mysqli_num_rows($result);

if ($r1 !=  0){
    echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <center><strong>Username Alredy Exist!</strong> </center>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";   
}
             elseif($pass==$cpass){
              $mypassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $sql="INSERT INTO `user` (`Username`, `Password`) VALUES (' $user', '$mypassword');"; 
            
            $result1=mysqli_query($conn,$sql);
            if($result1){
              $update = "UPDATE `user` SET `Username` = TRIM(' $user') WHERE `user`.`Username` = ' $user'";
            $result=mysqli_query($conn,$update);
            $create ="CREATE TABLE `notes`.`$user` ( `Sno` INT(50) NOT NULL AUTO_INCREMENT , `Title` VARCHAR(50) NOT NULL , `note` VARCHAR(200) NOT NULL , `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`Sno`)) ENGINE = MyISAM;";
            $sql=mysqli_query($conn,$create);
            }
            echo"
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <center><strong>Success!</strong> You Are Successfully created the Account with-".$user."<a href='login.php'> click Here</a></center>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            
            }else{
                echo"
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <center><strong>password must be same!</strong> </center>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";   
                 
            }
        
        }
    
    


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="sty.css" >
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
    </script>

    <title>Sign Up!</title>
  </head>
  <body>
  <?php


?>
  <div class="contanior " >
  <form action="signup.php" method="post" enctype="application/x-www-form-urlencoded">
         <tr>
       <br> <th class="heading" >Username</th>
        </tr><br>
<tr>
<td ><input type="text"name="username" class="from" required placeholder="Username"></td></tr><br>
<tr> <th class="heading"> Password</th><br>
</tr>
<tr><td><input type="password"name="password" class="from" required placeholder='Password'></td></tr><br>
<tr> <th class="heading">Confirm Password</th><br>
</tr>
<tr><td><input type="password"name="cpassword" class="from" required placeholder='Confirm Password'></td></tr><br>

<tr> <td> <input type="submit" class="btn btn-primary mt-3" id="submit" value="Sign Up"></button></td></tr><br>
 <pre> <br><tr> <td> <a href='login.php' id="login" >Login your Account Here</a></pre></td></tr>
</form></div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>