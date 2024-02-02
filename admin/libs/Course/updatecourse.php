<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_name='$newCourseName'");

        function UpdateCourse ($conn , $newCourseName , $cou_description , $course_id , $img){
                $updCourse = $conn->query("UPDATE course_tbl SET cou_name='$newCourseName' , cou_description='$cou_description' , img='$img' WHERE cou_id='$course_id' ");
                if($updCourse){
                        $res = array("status" => "success", "newCourseName" => $newCourseName);
                }else{
                        $res = array("status" => "failed");
                };

                return $res;
        };

        function UpdatePhot ($conn, $course_id , $newCourseName , $cou_description){
                $target_dir = "../../../uploads/imgs/courses/";
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
                };

                if ($_FILES["fileToUpload"]["size"] > 100000000) {
                $res = array("status" => "failed", "msg" => 'Sorry, your file is too large.');
                $uploadOk = 0;
                };
                
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $res = array("status" => "failed", "msg" => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
                $uploadOk = 0;
                };
        
                if ($uploadOk == 0) {
                $res = array("status" => "failed", "msg" => 'Sorry, your file was not uploaded.');
                echo json_encode($res);
                } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                $selCou = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$course_id'")->fetch(PDO::FETCH_ASSOC);
                                $target_dir = "../../../uploads/imgs/courses/";
                                $imagePath = $target_dir. $selCou['img'];
                                if (file_exists($imagePath) AND $selCou['img'] != 'default.png') {
                                        unlink($imagePath);
                                };
                                echo json_encode(UpdateCourse($conn , $newCourseName , $cou_description , $course_id , $photo_name));                                                      
                        } else {
                                $res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
                                echo json_encode($res);
                        };
                };
        };
        

        $selCourse2 = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$course_id'");
        if($selCourse->rowCount() > 0){
                if($selCourse->rowCount() > 0){
                        $selCourse2 = $selCourse2->fetch(PDO::FETCH_ASSOC);
                        if ($CheckPhoto == 'NoPhoto'){
                                echo json_encode(UpdateCourse($conn , $newCourseName , $cou_description , $course_id , $selCourse2['img']));                            
                        }else{
                                UpdatePhot ($conn, $course_id , $newCourseName , $cou_description);
                        };
                }else{
                        $res = array("status" => "exist", "newCourseName" => $newCourseName);
                        echo json_encode($res);
                };
        }else{
                $selCourse2 = $selCourse2->fetch(PDO::FETCH_ASSOC);
                if ($CheckPhoto == 'NoPhoto'){
                        echo json_encode(UpdateCourse($conn , $newCourseName , $cou_description , $course_id , $selCourse2['img']));                            
                }else{
                        UpdatePhot ($conn, $course_id , $newCourseName , $cou_description);
                };
        };
}else{
        header("location: ../../../index.php");
    };
?>

