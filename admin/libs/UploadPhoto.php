<?php
  session_start();
  /** @var object $conn */
  include("../AdminSession.php");
  include("../../conn.php");
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adminid = $_SESSION['adminid'];
    $selAadmin = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminid'");
    $selAadmin= $selAadmin->fetch(PDO::FETCH_ASSOC);

    $target_dir = "../profile/images/";
    $uploadOk = 1;
    $originalFilename = $_FILES["fileToUpload"]["name"];

    $imagePath = $target_dir. $selAadmin['admin_img'];
    if (file_exists($imagePath)) {
      unlink($imagePath);
    };

    $photo_name = bin2hex(random_bytes(8)).'.'. pathinfo($originalFilename, PATHINFO_EXTENSION);
    $updStudent = $conn->query("UPDATE admin_acc SET admin_img='$photo_name' WHERE admin_id='$adminid' ");
    
    $target_file = $target_dir . $photo_name;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $res = array("status" => "failed", "msg" => 'File is not an image.');
        $uploadOk = 0;
      }
    }

    if ($_FILES["fileToUpload"]["size"] > 1000000) {
      $res = array("status" => "failed", "msg" => 'Sorry, your file is too large.');
      $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $res = array("status" => "failed", "msg" => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      $res = array("status" => "failed", "msg" => 'Sorry, your file was not uploaded.');
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $res = array("status" => "success", "msg" => 'The file has ben uploaded.');
      } else {
        $res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
      }
    };
    echo json_encode($res);
  }else{
    header("location:../index.php");
  };
?>