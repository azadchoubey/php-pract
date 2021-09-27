<?php
         
            session_start();
            $msg='';
            if(isset($_SESSION['userid'])){     

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
                    header("Location:home.php");
                    exit();
                 
                }else{
                    $msg="Invaild Login Details";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }   

}else{}
?>