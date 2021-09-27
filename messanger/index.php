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
                    $data=$sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data as $row){
                        session_start();
                        $_SESSION['id']=$row['id'];
                        $_SESSION['name']=$row['user_id'];  
                        print_r( $_SESSION['id']);
                    }  
                   
                    $online_status=$con->prepare("UPDATE user_login SET status=1 WHERE id='{$_SESSION['id']}'");
                    if($online_status->execute()){
                        $checktable=$con->prepare("SELECT * FROM `$userid`");
                        $checktable->execute();
                       if($checktable){
                           header("Location:home.php");
                           exit();
                       }            
                    }else{
                        echo "failed to update status";
                    }

                      
                }else{
                    $msg="Invaild Login Details";
                }
            }catch(PDOException $e){
                
                if($e->errorInfo[1] == 1146){
                    //when table doesn't exist
                    $insert= $con->prepare("CREATE TABLE `$userid` ( `id` INT NOT NULL , `message` TEXT NOT NULL , `datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP )");
                    $insert->execute();
                    $insertid= $con->lastInsertId();
                   if($insertid>0){
                    header("Location:home.php");
                    exit();
                   }else{
                    // echo $e->getMessage();
                   }
                }else{
                    echo $e->getMessage();
                }      
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
