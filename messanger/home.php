<?php 
session_start();
header("Access-Control-Allow-Headers:*");

    if(isset($_SESSION['userid'])){           
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['userid']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>.col-lg-5{
   margin-top: 10%;
   background-color :WHITE;
}
.error{
    color:red;
}
</style>
</head>
<body>
<div class="col-lg-2 mx-5">
    <form  method="GET" action="home.php">
    <input type="submit" class="btn btn-danger" id="logout" value="Logout"name="logout"></div>
    </form>
<div class="container mt-5">
        <div class="row mt-5 ">
            <div class="col-lg-5 mx-auto">
            <span class="error mx-2"><center><?php  ?><center></span>
                <form  id ="form" class="mt-5 mx-2">
                    <div class="col"></div>
                    <textarea  class="form-control mt-3" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <input type="submit"  id ='send' class="d-grid gap-2 col-6 mx-auto btn btn-success mt-3 mb-4" value="Send"name="login" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script src="http://localhost/project/js/fetch_data.js"></script>
<?php 

 }
 else{
    header('location:index.php');
}
if(isset($_GET['logout'])){
    unset($_SESSION['userid']);
    header('location:index.php');
    exit();
 }
?>