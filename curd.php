<!DOCTYPE html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
    </script>
    <link rel="stylesheet" href="sty.css">
    <title>easyNote!</title>
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="curd.php">easyNote</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">About</a>
                    </li>

                </ul>

            </div>
            <p> <?php  session_start();
        $user=$_SESSION["username"];
                            
                          echo "<h6 class='sesstion' > <strong><u>Welcome:". $_SESSION["username"]."</u></strong> </h6>";
           ?> </p>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>


    </nav>


    <?php
    
 if (isset($_SESSION["username"])){
    if(time()-$_SESSION["login_time_stamp"] >300)   
    {  $_SESSION["username"] = $user;
        session_unset(); 
        session_destroy(); 
        header("Location:login.php"); 
    } 
   
 }
else{
    header("Location:login.php"); 
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
if(isset($_POST['snoEdit'])){
//update the records
$sno=$_POST['snoEdit'];
$title=$_POST['titleEdit'];
$note=$_POST['noteEdit'];

require 'db_config.php';
$sql ="UPDATE `$user` SET `Title` = '$title' ,  `note` = '$note' , `time` = CURRENT_TIMESTAMP WHERE `$user`.`Sno` = '$sno'";  
$RESULT= mysqli_query($conn, $sql);

if($RESULT){   
  echo"
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<center><strong>Success!</strong> Information Updated Successfully</center>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
else{
  echo"
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <center><strong>failed to update ! </strong> </center>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
}
elseif(isset($_POST['delNotes'])){

    $sno=$_POST['delNotes'];
    $title=$_POST['delTitle'];
    $note=$_POST['delnote'];
    
    require 'db_config.php';
    
    $sql = "DELETE FROM `$user` WHERE `$user`.`Sno` = '$sno';";
    $RESULT= mysqli_query($conn, $sql);
    
    if($RESULT){   
      echo"
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <center><strong>Success!</strong> Information Deleted Successfully</center>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    else{
      echo"
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <center><strong>failed to update ! </strong> </center>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    }
    elseif(isset($_POST['upload']))
    {
       
    $target_dir = 'uploads/'.$_SESSION['username'];
    if(!is_dir($target_dir)){   
        //Directory does not exist, so lets create it.
        mkdir($target_dir, 777);
    }
    
 $target_file = $target_dir.'/'.$_SESSION['username'] .'/'.($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
 
        $uploadOk = 1;
    }}
    
    //   } else {
    //     echo"
    //   <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    //   <center><strong>File is not an image. ! </strong> </center>
    //   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    //   </div>";


    //   //  echo "File is not an image.";
    //     $uploadOk = 0; 
    //   } 

        if (file_exists($target_file)) {

            echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <center><strong>Sorry, file already exists. ! </strong> </center>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";

       //  echo "Sorry, file already exists.";
          $uploadOk = 0;
        
        
        }

        // Check file size
         
        elseif ( $_FILES["fileToUpload"]["size"] > 500000) {
            echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <center><strong>Sorry, your file is too large. ! </strong> </center>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
      
         
           //echo "Sorry, your file is too large.";
          $uploadOk = 0;
        
        
        }
        
        // Allow certain file formats
        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $videoFileType = "mp4") {
            echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <center><strong>Sorry, only JPG, JPEG, PNG & GIF files are allowed.! </strong> </center>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
         
        

        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        
        
        }
        if (empty($_FILES["fileToUpload"])) {
            
       
            echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <center><strong>Sorry, only JPG, JPEG, PNG & GIF files are alloweded.! </strong> </center>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"; 
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        elseif ($uploadOk == 0 ) {
            echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <center><strong>Sorry, your file was not uploaded.! </strong> </center>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        // echo "Sorry, your file was not uploaded.";

        
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <center><strong>Success!</strong> The file -". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]))." has been uploaded.</center>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";

           
           //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        
        
          } else {
            echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <center><strong>Sorry, there was an error uploading your file.! </strong> </center>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
           
         //  echo "Sorry, there was an error uploading your file.";
        
        
          }
        }
    } 
   elseif (isset($_POST['add'])){

$title=$_POST['title'];
$note=$_POST['note'];


require 'db_config.php';

$sql ="INSERT INTO `$user` (`Sno`, `Title`, `note`, `time`) VALUES (NULL, '$title', '$note', CURRENT_TIMESTAMP);";
  

$RESULT= mysqli_query($conn, $sql);
if($RESULT){   
  echo"
<div class='alert alert-success alert-dismissible fade show' role='alert'>
<center><strong>Success!</strong> Information Added Successfully</center>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
else{
  echo"
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <center><strong>failed to update ! </strong> </center>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }


}}

?>


    <h3 class="container mt-3"><u>
            <center>Welcome to easyNote!</center>
        </u> </h3>
    <hr>
    <div class="container mt-3">

        <h3> Add a Note!</h3>
        <div class="mb-3">
            <form action="curd.php" method="POST">
                <label for="exampleFormControlInput1" class="form-label">Add Title</label>
                <input type="text" class="form-control" id="title" name="title" required><br>
                <label for="exampleFormControlTextarea1" class="form-label"> Take Note</label>
                <textarea class="form-control" id="note" name="note" rows="3" required></textarea><br>

                <input type="submit" class="btn btn-primary" value="Submit" name="add"></button>
            </form>
            <form action="curd.php" method="post" enctype="multipart/form-data" class="mb-3 mt-4">
                <strong>Select image to upload:
                </strong>
                <input type="file" class="btn btn-primary" name="fileToUpload" id="fileToUpload" required>
                <input type="submit" class="btn btn-primary" value="Upload Image" name="upload">
            </form>
        </div>
    </div>
    <?php
//     global $target_file;
// $target_file; //Let say If I put the file name Bang.png
// echo "<a href='download.php?nama=".$target_file."'>download</a> ";

// Array containing sample image file names

$path='uploads/'.$_SESSION['username'];
if(file_exists($path)){
$dir_handle = opendir($path) or die("Unable to open $path");
      while ($file = readdir($dir_handle)) {
        if ($file == '.' || $file == '..') {
          continue;
        } 
  // Process download
  $name =$path.'/'.$file ;
$images = array($name);

// Loop through array to create image gallery
foreach($images as $image){
    echo '<div class="img-box">';
        echo '<img src="'.$image.'" width="200" alt="' .pathinfo($image, PATHINFO_FILENAME).'">';
        echo '<p><a href="download.php?file=' .urlencode($image).'">Download</a></p>';
    echo '</div>';
} 
     
} echo '<p><a href="download.php?allzip='.$path.'">Download</a></p>';


}
?>

    <hr>
    <?php
require 'db_config.php';
$dis = "SELECT * FROM $user";
$disply = mysqli_query($conn, $dis);
if (mysqli_num_rows($disply) > 0) {
  $sno=0;
  ?>
    <table id="table" class="table-primary">
        <thead>
            <tr class="table-primary">
                <th>Sno</th>
                <th>Title</th>
                <th>Notes</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php while($row = mysqli_fetch_assoc($disply)) {
      $sno+1;
      $sno++;?>
            <tr>
                <td class="table-primary"> <?php echo $sno ?> </td></strong>
                <td class="table-primary"><?php echo $row['Title'];?> </td>
                <td class="table-primary"><?php echo $row['note'];?> </td>
                <td class="table-primary"><?php echo $row['time'];?> </td>
                <td class="table-primary"> <button type="button" id='  <?php echo $row['Sno'];?> '
                        class=" edit btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@getbootstrap">Edit</button>
                    <button type="button" class=" delete btn btn-primary" id=' <?php echo $row['Sno'];?> '
                        data-bs-toggle="modal" data-bs-target="#exampleModal2"
                        data-bs-whatever="@getbootstrap">Delete</button>
                </td>
            </tr>
            <?php }}?>

        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="curd.php" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="noteEdit" name="noteEdit"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete The Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="curd.php" method="POST">
                        <input type="hidden" name="delNotes" id="delNotes">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="delTitle" name="delTitle" required="true"
                                readonly="true">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="delnote" name="delnote" required="true"
                                readonly="true"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="Submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
    </script>

    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit", );
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[1].innerText;
            Note = tr.getElementsByTagName("td")[2].innerText;
            console.log(title, Note);
            titleEdit.value = title;
            noteEdit.value = Note;
            snoEdit.value = e.target.id;
            console.log(e.target.id);

        })


    })

    Delete = document.getElementsByClassName('delete');
    Array.from(Delete).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("Delete", );
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[1].innerText;
            Note = tr.getElementsByTagName("td")[2].innerText;
            console.log(title, Note);
            delTitle.value = title;
            delnote.value = Note;
            delNotes.value = e.target.id;
            console.log(e.target.id);
        })


    })
    </script>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    </script>

    <?php include 'flooter.php'; ?>
</body>

</html>