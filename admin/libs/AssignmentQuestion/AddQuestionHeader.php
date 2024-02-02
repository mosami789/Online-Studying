<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
            if ($CheckPhoto == 'NoPhoto'){
                $insQue = $conn->query("INSERT INTO assi_question_header(title, assi_id, que_text) VALUES('$title','$assi_id', '$text') ");
                if($insQue)
                {
                    $res = array("status" => "success");
                }
                else
                {
                    $res = array("status" => "failed", "msg" => 'Sorry, there was an error , please try again.');
                }
            }else{
                $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif' , 'image/jpg');
                $uploaded_file_mime_type = $_FILES['fileToUpload']['type'];

                if (in_array($uploaded_file_mime_type, $allowed_mime_types)) {

                    $target_dir = "../../../uploads/imgs/assignments/";
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
                            $insQue = $conn->query("INSERT INTO assi_question_header(title, assi_id, que_text , img) VALUES('$title','$assi_id', '$text' , '$photo_name') ");
                            $res = array("status" => "success");
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