<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
/** @var object $conn */
include("../conn.php");
extract($_POST);
$stuid = $_SESSION['Student_ID'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($CheckPhoto == 'NoPhoto'){
            $insQuestion = $conn->query("INSERT INTO stu_questions(stu_id, question) VALUES('$stuid','$Question') ");
            if($insQuestion)
            {
                $res = array("status" => "success");
            }else{
                $res = array("status" => "failed");
            };
            echo json_encode($res);
        }else{

            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif' , 'image/jpg');
            $uploaded_file_mime_type = $_FILES['fileToUpload']['type'];

            if (in_array($uploaded_file_mime_type, $allowed_mime_types)) {

                $target_dir = "../uploads/imgs/questions/";
                $uploadOk = 1;
                $originalFilename = $_FILES["fileToUpload"]["name"];

                $photo_name = bin2hex(random_bytes(8)).'.'. pathinfo($originalFilename, PATHINFO_EXTENSION);
                $target_file = $target_dir . $photo_name;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if ($_FILES["fileToUpload"]["size"] > 100000000) {
                    $res = array("status" => "failed", "msg" => 'Sorry, your file is too large.');
                    $uploadOk = 0;
                };

                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    $res = array("status" => "failed", "msg" => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    $res = array("status" => "failed", "msg" => 'Sorry, your file was not uploaded.');
                    } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $insQuestion = $conn->query("INSERT INTO stu_questions(stu_id, question , img) VALUES('$stuid','$Question','$photo_name') ");
                        $res = array("status" => "success");
                    } else {
                        $res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
                    };
                };
            } else {
                $res = array("status" => "failed" , "msg" => "The uploaded file is not an image.");
            };
            echo json_encode($res);
        };
    }else{
        header("location:../index.php");
    };
} else {
  header("location:../index.php");
};
?>