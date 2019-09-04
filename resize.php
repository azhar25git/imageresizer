<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "php-image-resize-master/lib/ImageResize.php";
require "php-image-resize-master/lib/ImageResizeException.php";

use \Gumlet\ImageResize;

$target_dir = __DIR__.'/uploads/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$uploadedImageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $file = $_FILES["fileToUpload"]["name"];
    $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
    $fileBaseName = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_FILENAME);
    // var_dump($_FILES);exit;
    
    // Receive width and height
    $width = (int) $_POST['width'];
    $height = (int) $_POST['height'];

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($uploadedImageFileType != "jpg" && $uploadedImageFileType != "png" && $uploadedImageFileType != "jpeg"
&& $uploadedImageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// echo $fileBaseName;exit;
// var_dump($_FILES);exit;

try {
    if(file_exists($target_file)) {
        
        $uploadedImage = new ImageResize($target_file);
        
        if(isset($width) && isset($height)) {
            $uploadedImage->resize($width, $height);
        } elseif (isset($width) && !isset($height)) {
            $uploadedImage->resizeToWidth($width);
        } elseif (isset($height) && !isset($width)) {
            $uploadedImage->resizeToHeight($height);
        } else {
            $uploadedImage->resizeToWidth(700);
        }
        
        // $newName = time(). '.'.$ext;
        $newName = $fileBaseName . '_'. time() . '.' . $ext;
        $newNameLocation = $target_dir .'/'. $newName;
        
        if($uploadedImage->save($newNameLocation)){
            
            echo '<img src="uploads/'.$newName.'">';
            @unlink($target_file);
        }else {
            echo 'error saving';
        }
    }else {
        echo '<br>';
        echo 'No file';
    }

}catch( \Exception $e ) {
    // @unlink($file);
    echo '<br>';
    echo "Error Message: ". $e->getMessage();
}
?>
