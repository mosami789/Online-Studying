<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 
 extract($_POST);
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $selLecChech = $conn->query("SELECT * FROM lec_tbl WHERE lec_name='$newLecname' AND cou_id='$cou_id'");
     $selLecInfo = $selLecChech->fetch(PDO::FETCH_ASSOC);

     function UpdateLecture($conn,$newLecname,$video_link,$lec_description,$Lec_Time,$lec_id ,$img){
          $updCourse = $conn->query("UPDATE lec_tbl SET lec_name='$newLecname' ,video_link='$video_link' , lec_description='$lec_description' ,lec_time='$Lec_Time' , img='$img' WHERE lec_id='$lec_id' ");
          if($updCourse)
          {
                  $res = array("status" => "success", "newLecname" => $newLecname);
          }
          else
          {
                  $res = array("status" => "failed");
          }
          return $res;
     };

     if ($selLecChech->rowCount() > 0 AND $selLecInfo['lec_id'] != $lec_id){
          echo json_encode(array("status" => "exist", "newLecname" => $newLecname));
     }else{

          if ($CheckPhoto == 'NoPhoto'){
               $img = $selLecInfo['img'];
               echo json_encode(UpdateLecture($conn,$newLecname,$video_link,$lec_description,$Lec_Time,$lec_id,$img));
          }else{
               $target_dir = "../../../uploads/imgs/lectures/";
               $uploadOk = 1;
               $originalFilename = $_FILES["fileToUpload"]["name"];

               $photo_name = bin2hex(random_bytes(8)).'.'. pathinfo($originalFilename, PATHINFO_EXTENSION);
               $target_file = $target_dir . $photo_name;
               $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

               $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
               if($check !== false) {
                    $uploadOk = 1;
               } else {
                    $res = array("status" => "failed", "msg" => 'File is not an image.');
                    $uploadOk = 0;
               }

               if ($_FILES["fileToUpload"]["size"] > 100000000) {
                    $res = array("status" => "failed", "msg" => 'Sorry, your file is too large.');
                    $uploadOk = 0;
                    }
               
               if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
               $res = array("status" => "failed", "msg" => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
               $uploadOk = 0;
               }

               if ($uploadOk == 0) {
                    $res = array("status" => "failed", "msg" => 'Sorry, your file was not uploaded.');
               } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                         $target_dir = "../../../uploads/imgs/lectures/";
                         $imagePath = $target_dir. $selLecInfo['img'];
                         if (file_exists($imagePath)) {
                              unlink($imagePath);
                         };
                         UpdateLecture($conn,$newLecname,$video_link,$lec_description,$Lec_Time,$lec_id,$photo_name);
                         $res = array("status" => "success", "newLecname" => $newLecname);

                    } else {
                         $res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
                    };
               };
               echo json_encode($res);
          };
     };
}else{
     header("location: ../../../index.php");
 };
?>