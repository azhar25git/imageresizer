<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "php-image-resize-master/lib/ImageResize.php";
require "php-image-resize-master/lib/ImageResizeException.php";

use \Gumlet\ImageResize;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    // $upload_folder = (string) $_POST['uploadFolder'];
    $upload_folder = (string) '';
    $default_dir = "uploads/";
    if($upload_folder == ''){
        $target_dir = __DIR__ . '/' . $default_dir;
        $upload_dir = $default_dir;
        
    } else {
        $target_dir = __DIR__ . '/' . $upload_folder;
        $default_dir = $target_dir;
    }
    // echo $target_dir;exit;
    $file_count = count($_FILES['fileToUpload']['name']);

    // Receive width and height
    $width = (int) $_POST['width'];
    $height = (int) $_POST['height'];

    for ($i=0;$i<$file_count;$i++) {

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
        $upload_ok = 1;
        $uploaded_image_filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $file = $_FILES["fileToUpload"]["name"][$i];
        $ext = pathinfo($_FILES["fileToUpload"]["name"][$i], PATHINFO_EXTENSION);
        $file_base_name = pathinfo($_FILES["fileToUpload"]["name"][$i], PATHINFO_FILENAME);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);

        if($check !== false) {
            echo "<script>console.log('File is an image - " . $check["mime"] . ".')</script>";
            $upload_ok = 1;
        } else {
            echo "<script>console.log('File is not an image.')</script>";
            $upload_ok = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>console.log('Sorry, file already exists.')</script>";
            $upload_ok = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"][$i] > 50000000) {
            echo "<script>console.log('Sorry, your file is too large.')</script>";
            $upload_ok = 0;
        }

        // Allow certain file formats
        if($uploaded_image_filetype != "jpg" && $uploaded_image_filetype != "png" && $uploaded_image_filetype != "jpeg"
        && $uploaded_image_filetype != "gif" ) {
            echo "<script>console.log('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
            $upload_ok = 0;
        }

        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            echo "<script>console.log('Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                echo "<script>console.log('The file ". basename( $_FILES["fileToUpload"]["name"][$i]). " has been uploaded.')</script>";
            } else {
                echo "<script>console.log('Sorry, there was an error uploading your file.')</script>";
            }
        }

        try {
            if(file_exists($target_file)) {
                
                $uploaded_image = new ImageResize($target_file);
                
                if ( $width !== 0 && $height !== 0 ) {
                    // echo 'both set';exit;
                    $uploaded_image->resize($width, $height);
                    $new_name = $file_base_name . '_' . $width . 'x' . $height . '.' . $ext;
                } elseif ( $width !== 0 && $height === 0 ) {
                    // echo 'only width set';exit;
                    $uploaded_image->resizeToWidth($width);
                    $new_name = $file_base_name . '_' . $width . '.' . $ext;
                } elseif ( $height !== 0 && $width === 0 ) {
                    // echo 'only height set';exit;
                    $uploaded_image->resizeToHeight($height);
                    $new_name = $file_base_name . '_' . $height .'.' . $ext;
                } else {
                    // echo 'nothing set';exit;
                    $uploaded_image->resizeToWidth(700);
                    $new_name = $file_base_name . '_700.' . $ext;
                }
                
                // $new_name = $file_base_name . '_'. time() . '.' . $ext;
                $new_name_location = $target_dir .'/'. $new_name;
                $final_link = $upload_dir . '/' . $new_name;

                if($uploaded_image->save($new_name_location)){
                    
                    echo "<script>console.log('Done');";
                    echo "document.getElementById('image-box').insertAdjacentHTML('beforeend', '<a class=\"p-3\" href=\"".$final_link."\" download=\"".$new_name."\"> <img class=\"img-thumbnail\"src=\"".$final_link."\" alt=\"image\" width=\"180\" height=\"180\"> </a>');</script>";
                    @unlink($target_file);
                }else {
                    echo "<script>console.log('error saving')</script>";
                }
            }else {
                echo "<script>console.log('<br>'')</script>";
                echo "<script>console.log('No file'')</script>";
            }

        }catch( \Exception $e ) {
            // @unlink($file);
            echo "<script>console.log('<br>'')</script>";
            echo "<script>console.log('Error Message: " . $e->getMessage() . "')</script>";
        }


    }
    

}else {
    echo "<script>console.log('No POST Request Was Sent.')</script>";
}
?>
<!-- <script>
setTimeout(function(){
            window.history.back();
         }, 7000);
</script> -->
