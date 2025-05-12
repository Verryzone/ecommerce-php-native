<?php 
include_once("functions.php");

if(isset($_POST["save_product_serial"]) && $_POST["save_product_serial"] == 'user_token'){
      $name = $_POST["name"];
      $description = $_POST["description"];
      $price = $_POST["price"];
      $stock = $_POST["stock"];
      $category_id = $_POST["category_id"];

      $image_url = null;

      // Handle file upload
      if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/images/';
            $thumbDir = '../uploads/thumbnails/';
            $imageName = time() . '_' . basename($_FILES['product_image']['name']);
            $imagePath = $uploadDir . $imageName;
            $thumbPath = $thumbDir . 'thumb_' . $imageName;
            $image_url = $imageName;

            
            if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $imagePath)) {
                  echo json_encode(['status' => 0, 'message' => 'Failed to upload image']);
                  exit;
            }

            // Buat thumbnail
            $source = $imagePath;
            $imageType = mime_content_type($source);
            $targetWidth = 50;
            $targetHeight = 50;

            switch ($imageType) {
                  case 'image/jpeg':
                        $sourceImage = imagecreatefromjpeg($source);
                        break;
                  case 'image/png':
                        $sourceImage = imagecreatefrompng($source);
                        break;
                  case 'image/gif':
                        $sourceImage = imagecreatefromgif($source);
                        break;
                  default:
                        echo json_encode(['status' => 0, 'message' => 'Unsupported image type']);
                        exit;
            }

            $newImage = imagecreatetruecolor($targetWidth, $targetHeight);
            $originalWidth = imagesx($sourceImage);
            $originalHeight = imagesy($sourceImage);
            imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $originalWidth, $originalHeight);

            switch ($imageType) {
                  case 'image/jpeg':
                        imagejpeg($newImage, $thumbPath, 90);
                        break;
                  case 'image/png':
                        imagepng($newImage, $thumbPath);
                        break;
                  case 'image/gif':
                        imagegif($newImage, $thumbPath);
                        break;
            }

            imagedestroy($sourceImage);
            imagedestroy($newImage);
      }
      
      

      $status = 0;
      $message = 'Failed to save data!';
      if($_POST['request_'] == 'new') {
            $args = "INSERT INTO products (`name`, `description`, price, stock, category_id, image_url) VALUES ('$name', '$description', '$price', '$stock', '$category_id', '$image_url')";
            $simpan = mysqli_query($dbconnect, $args);
            if($simpan) {
                  $status = 1;
                  $message = "successfully saved data";
            }
      } else if($_POST['request_'] == 'edit') {
            $id = $_POST['id'];

            $sqlimage = '';
            if($image_url !== null) {
                  $sqlimage = ", image_url='$image_url'";
            }
            $args = "UPDATE products SET `name`='$name', `description`='$description', price='$price', stock='$stock', category_id='$category_id' $sqlimage WHERE id = '$id'";
            $simpan = mysqli_query($dbconnect, $args);
            if($simpan) {
                  $status = 1;
                  $message = "successfully updated data";
            }
      }

      $response = [
            "status"=> $status,
            "message"=> $message
      ];

      echo json_encode($response);
}

if(isset($_POST["delete_product_serial"]) && $_POST["delete_product_serial"] == 'user_token'){
      $id = $_POST['id'];
      $args = "DELETE FROM products WHERE id = '$id'";
      $hapus = mysqli_query($dbconnect, $args);
      if($hapus) {
            $status = 1;
            $message = "Successfully deleted data";
      } else {
            $status = 0;
            $message = "Failed to delete data";
      }
      $response = [
            "status"=> $status,
            "message"=> $message
      ];
      echo json_encode($response);
}

// save category
if(isset($_POST["save_category_serial"]) && $_POST["save_category_serial"] == 'user_token'){
      $code = $_POST["code"];
      $name = $_POST["name"];
      $parent_id = $_POST["parent_id"];

      $status = 0;
      $message = 'Failed to save data!';
      if($_POST['request_'] == 'new') {
            $args = "INSERT INTO categories (code, `name`, parent_id) VALUES ('$code', '$name', '$parent_id')";
            $simpan = mysqli_query($dbconnect, $args);
            if($simpan) {
                  $status = 1;
                  $message = "Successfully saved data";
            }
      } else if($_POST['request_'] == 'edit') {
            $id = $_POST['id'];

            $args = "UPDATE categories SET `code`='$code', `name`='$name', `parent_id`='$parent_id' WHERE id = '$id'";
            $simpan = mysqli_query($dbconnect, $args);
            if($simpan) {
                  $status = 1;
                  $message = "Successfully updated data";
            }
      }

      $response = [
            "status"=> $status,
            "message"=> $message
      ];

      echo json_encode($response);
}
?>