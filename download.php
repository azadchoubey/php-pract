<?php
session_start();
    if(isset($_GET['file'])){
      $files = urldecode($_REQUEST["file"]);
 
   
   // Process download
  
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
 }       } 

      
if(isset($_GET['allzip'])){
  $path=($_REQUEST["allzip"]);
  $zipfolder = 'uploads/' . $_SESSION['username'];
$dir_handle = opendir($path) or die("Unable to open $path");
    while ($file = readdir($dir_handle)) {
      if ($file == '.' || $file == '..') {
    continue;
 }$name = $path .'/'. $file;

 $zip = new ZipArchive;
 //Set Zip file name
 $zip_name = $zipfolder.'/'.'download'.'.zip';
 $zip->open($zip_name, ZIPARCHIVE::CREATE);

 $zip->addFile($name);
 $zip->close(); 
   }header('Content-Description: File Transfer');
   header("Content-type: application/octet-stream");
 // header("Content-Disposition: attachment; filename=\"".$zipname."\"");
 header('Content-Disposition: attachment; filename="'.basename($zip_name).'"');
 header('Expires: 0');
 header('Cache-Control: must-revalidate');
 header('Pragma: public');
 header('Content-Length: '.filesize($zip_name));
 readfile($zip_name);
  }

 ?>

