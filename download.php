<?php
session_start();
    if(isset($_GET['file'])){
      $files = urldecode($_REQUEST["file"]);
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
 
      }
      
if(isset($_GET['allzip'])){

  $path=$_GET['allzip'];
    $dir_handle = opendir($path) or die("Unable to open $path");
    while ($file = readdir($dir_handle)) {
      if ($file == '.' || $file == '..') {
        continue;
      } 
      $name = $path . '/' . $file;
      // var_dump(   $name);
      $images = array($name);
       var_dump($images);
    if(file_exists($path)) {
    
   
    foreach ($images as $files) {
 $zipname = ''.$_SESSION['username'].'.zip';
   
    $zip = new ZipArchive;
    $zip->open($name, ZipArchive::CREATE);
  
    //   $fileContent = file_get_contents($file);
    //   $zip->addFromString(basename($file), $fileContent);
    //   // var_dump($zip);
  }
  $zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$files);
header('Content-Disposition: attachment; filename="'.basename($files).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($files));
flush();
readfile($files);
}}}

