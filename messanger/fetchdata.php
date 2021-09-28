<?php
         
            session_start();
            if(isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_POST['data'])){    
              $table=$_SESSION['name'];
            try{
                $con= new PDO("mysql:host=localhost;dbname=messenger",'root','');
                $sql= $con->prepare("SELECT * FROM  $table");
                $sql->execute();
               $row=$sql->rowCount();
                if($row>0){
                        $data=$sql->fetchAll(PDO::FETCH_ASSOC);
                        foreach( $data as $list){
                                echo json_encode($list);
                        }
                }else{
                   echo json_encode('not working');
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }   

}elseif(isset($_POST['onlinestatus'])){
    $con= new PDO("mysql:host=localhost;dbname=messenger",'root','');
     $checkstatus=$con->prepare("SELECT * FROM user_login WHERE status=1");
     $checkstatus->execute();
$result= $checkstatus->fetchAll(PDO::FETCH_ASSOC);
       
        echo json_encode($result);

}
?>