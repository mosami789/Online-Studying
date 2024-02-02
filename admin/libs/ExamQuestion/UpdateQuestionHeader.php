<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selHeaderQue = $conn->query("SELECT * FROM exam_question_header WHERE que_id='$id'");
        $selHeader = $selHeaderQue->fetch(PDO::FETCH_ASSOC);

        if ($CheckPhoto == 'NoPhoto'){
            $updQuestion = $conn->query("UPDATE exam_question_header SET title='$title', Que_Text='$text'  WHERE que_id='$id' ");
            if($updQuestion)
            {
                $res = array("status" => "success");
            }else{
                $res = array("status" => "failed", "msg" => 'Sorry, there was an error , please try again.');
            };
        }elseif ($CheckPhoto == "Update_PhotoFound"){

            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif' , 'image/jpg');
            $uploaded_file_mime_type = $_FILES['fileToUpload']['type'];

            if (in_array($uploaded_file_mime_type, $allowed_mime_types)) {

                $target_dir = "../../../uploads/imgs/exams/";
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

                        $target_dir = "../../../uploads/imgs/exams/";
                        $imagePath = $target_dir. $selHeader['img'];
                        if (file_exists($imagePath)) {
                          unlink($imagePath);
                        };


                        $updQuestion = $conn->query("UPDATE exam_question_header SET img='$photo_name'  WHERE que_id='$id' ");
                        if($updQuestion)
                        {
                            $res = array("status" => "success");
                        }else{
                            $res = array("status" => "failed", "msg" => 'Sorry, there was an error , please try again.');
                        };
                    } else {
                        $res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
                    };
                };

            } else {
                $res = array("status" => "failed" , "msg" => "The uploaded file is not an image.");
            };


        }else{

            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif' , 'image/jpg');
            $uploaded_file_mime_type = $_FILES['fileToUpload']['type'];

            if (in_array($uploaded_file_mime_type, $allowed_mime_types)) {

                $target_dir = "../../../uploads/imgs/exams/";
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

                        $target_dir = "../../../uploads/imgs/exams/";
                        $imagePath = $target_dir. $selHeader['img'];
                        if (file_exists($imagePath)) {
                          unlink($imagePath);
                        };


                        $updQuestion = $conn->query("UPDATE exam_question_header SET title='$title', Que_Text='$text' , img='$photo_name'  WHERE que_id='$id' ");
                        if($updQuestion)
                        {
                            $res = array("status" => "success");
                        }else{
                            $res = array("status" => "failed", "msg" => 'Sorry, there was an error , please try again.');
                        };
                    } else {
                        $res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
                    };
                };

            } else {
                $res = array("status" => "failed" , "msg" => "The uploaded file is not an image.");
            };

        };

    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
 ?>