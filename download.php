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
  $sec='uploads/'.$_SESSION['username'];
    $dir_handle = opendir($path) or die("Unable to open $path");
    while ($file = readdir($dir_handle)) {
      if ($file == '.' || $file == '..') {

    }  $name = $sec . '/'. $file;
    $images = array($name);
 
    $zip = new ZipArchive;
      $zipname =$sec.'/'.$_SESSION['username'].".zip";
     
 $zip->open($zipname, ZipArchive::CREATE);


    $zip->addFile($name);
    // $zip->addFile($files);
    header('Content-Description: File Transfer');
    header("Content-type: application/octet-stream");
  // header("Content-Disposition: attachment; filename=\"".$zipname."\"");
  header('Content-Disposition: attachment; filename="'.basename($zipname).'"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($zipname));
  readfile($zipname);
   }$zip->close();
     
  }
 



