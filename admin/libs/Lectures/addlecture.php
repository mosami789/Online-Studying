<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $selLecture = $conn->query("SELECT * FROM lec_tbl WHERE lec_name='$lec_name' AND cou_id='$cou_id' ");
 if($selLecture->rowCount() > 0)
 {
	$res = array("status" => "exist", "lec_name" => $lec_name);
 }else{	
		try {			
			if ($CheckPhoto == 'NoPhoto'){
				$photo_name = "defult.png";
				$insLecture = $conn->query("INSERT INTO lec_tbl(lec_name, cou_id ,video_link ,lec_description ,lec_time , img) VALUES('$lec_name','$cou_id', '$video_link' ,' $lec_description' ,'$Lec_Time' ,'$photo_name')");
				$res = array("status" => "success", "lec_name" => $lec_name);
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
			  
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				$res = array("status" => "failed", "msg" => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
				$uploadOk = 0;
				}
			
				if ($uploadOk == 0) {
					$res = array("status" => "failed", "msg" => 'Sorry, your file was not uploaded.');
					} else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							$insLecture = $conn->query("INSERT INTO lec_tbl(lec_name, cou_id ,video_link ,lec_description ,lec_time , img) VALUES('$lec_name','$cou_id', '$video_link' ,' $lec_description' ,'$Lec_Time' ,'$photo_name')");
							$res = array("status" => "success", "lec_name" => $lec_name);
						} else {
							$res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
						};
				};
			};
		} catch (\Throwable $e) {
			$res = array("status" => "failed", "msg" => 'Sorry, there was an error uploading your file.');
		}
	};
 echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>