<?php
            $msg='';
 if(isset($_POST['login']))  {
  
     $userid = $_POST['userid'];
     $password = $_POST['password'];
            try{
                $con= new PDO("mysql:host=localhost;dbname=messenger",'root','');
                $sql= $con->prepare("SELECT * FROM user_login WHERE user_id='$userid'  and Password='$password'");
                $sql->execute();
               $row=$sql->rowCount();
                if($row>0){
                    session_start();
                    $_SESSION['userid']=$userid;
                    $checktable=$con->prepare("SELECT *  FROM `$userid`");
                    $checktable->execute();
                  echo  $table=$checktable->rowCount();
                    if($table>0){
                        header("Location:home.php");
                        exit();
                    }else{
                        $insert= $con->prepare("CREATE TABLE `$userid` ( `id` INT NOT NULL , `message` TEXT NOT NULL , `datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP )");
                        $insert->execute();
                       echo $insertid= $con->lastInsertId();
                       if($insertid>0){
                        header("Location:home.php");
                        exit();
                       }else{
                        // echo $e->getMessage();
                       }
                    }
                   

                 
                }else{
                    $msg="Invaild Login Details";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }   

}else{}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>.col-lg-5{
   margin-top: 10%;
   background-color :WHITE;
   border: 1px solid black;
}
.form-control{
    border: 1px solid black;
}
.error{
    color:red;
}
</style>
<body>
    
<div class="container mt-5">
        <div class="row mt-5 ">
            <div class="col-lg-5 mx-auto">
            <span class="error mx-2"><center><?php  echo $msg;?><center></span>
                <form method="post" action="index.php" class="mt-5 mx-2">
                    <input type="text" class="form-control mt-3" required name="userid" placeholder="Enter User Id ">
                    <input type="password" class="form-control mt-3" required name="password" placeholder="Enter Password">
                    <input type="submit" class="d-grid gap-2 col-6 mx-auto btn btn-success mt-3 mb-4" value="Login"name="login" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>
