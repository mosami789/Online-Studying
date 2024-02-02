<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
  /** @var object $conn */
  include("../conn.php");
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stuid = $_SESSION['Student_ID'];
    $selstudent = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid'");
    $selstudent= $selstudent->fetch(PDO::FETCH_ASSOC);

    $target_dir = "../uploads/imgs/profiles/";
    $uploadOk = 1;
    $originalFilename = $_FILES["fileToUpload"]["name"];

    $imagePath = $target_dir. $selstudent['stu_profile'];
    if (file_exists($imagePath)) {
      unlink($imagePath);
    };

    $photo_name = bin2hex(random_bytes(8)).'.'. pathinfo($originalFilename, PATHINFO_EXTENSION);
    $updStudent = $conn->query("UPDATE student_tbl SET stu_profile='$photo_name' WHERE stu_id='$stuid' ");
    
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
}else{
  header("location:../index.php");
};?>