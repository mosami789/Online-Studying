<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_name='$cou_name'");

    if($selCourse->rowCount() > 0){
        $res = array("status" => "exist", "cou_name" => $cou_name);
        echo json_encode($res);
    }else{

        $admin_id = $_SESSION['adminid'];
        function InsertCourse($conn , $cou_name , $cou_description , $admin_id , $img){
            $insCourse = $conn->query("INSERT INTO course_tbl(cou_name, cou_description, admin_created , img) VALUES('$cou_name','$cou_description', '$admin_id' , '$img') ");
            if($insCourse){
                $res = array("status" => "success", "cou_name" => $cou_name);
            }else{
                $res = array("status" => "failed", "cou_name" => $cou_name);
            };
            return $res;
        };

        if ($CheckPhoto == 'NoPhoto'){
            echo json_encode(InsertCourse($conn , $cou_name , $cou_description , $admin_id , 'default.png'));
        }else{
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
                    echo json_encode(InsertCourse($conn , $cou_name , $cou_description , $admin_id , $photo_name));                            
                } else {
                    $res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
                    echo json_encode($res);
                };
            };
        };
    };
}else{
    header("location: ../../../index.php");
};
?>