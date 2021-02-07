<?php
session_start();
    if(isset($_GET['file'])){
      $files = urldecode($_REQUEST["file"]);

      }
      $Name = $_GET['file'];
     $path='uploads/'.$_SESSION['username'];
     // Open the folder
      $dir_handle = opendir($path) or die("Unable to open $path");
      while ($file = readdir($dir_handle)) {
        if ($file == '.' || $file == '..') {
          continue;
        } 
  // Process download
 
// var_dump($images);
  if(file_exists($files)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($files).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($files));
    flush(); // Flush system output buffer
    readfile($files);
} else {  
    http_response_code(404);  
  die();     closedir($dir_handle);
} }












//     // $name =$path.'/'.$file ;
//     // echo  "<Br>".$name."";
//     // $fp = fread($name, 'rb');
    
//     // // send the right headers
// // header("Content-Type: image/jpeg");
//     // header("Content-Length: " . filesize($name));
    
//     // // dump the picture and stop the script
//     // fpassthru($fp);
//     // exit;
    



      
    
    

        // $zip = new ZipArchive();
        // $zip_name = "azad.zip"; // Zip name
        // $zip->open($path); 
        //     if(file_exists($path)){
        //     $zip->addFromString(basename($path),  file_get_contents($path)); 
        //     header('Content-Type: application/zip');
        //     header('Content-disposition: attachment; filename='.$zipname);
        //     header('Content-Transfer-Encoding: binary');
        //     header('Expires: 0');
        //     header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        //     header('Pragma: public');
        //     header('Content-Length: ' . filesize($zipname));
        //     ob_clean();
        //     flush();
        //     readfile($zipname);
            

        //     }
        //     else{
        //      echo"file does not exist";
        //     }
        //   }$zip->close();
          
        // function download($target_dir) {
        //     if (file_exists($target_dir)) {
        //         header('Content-Description: File Transfer');
        //         header('Content-Type: application/octet-stream');
        //         header('Content-Disposition: attachment; filename='.basename($target_dir));
        //         header('Content-Transfer-Encoding: binary');
        //         header('Expires: 0');
        //         header('Cache-Control: must-revalidate');
        //         header('Pragma: public');
        //         header('Content-Length: ' . filesize($target_dir));
        //         ob_clean();
        //         flush();
        //         readfile( $target_dir);
        //         exit;}
        //     }
        //
        
        
     
    
?>