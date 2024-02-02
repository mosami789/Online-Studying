<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$selCou = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
	$delCourse = $conn->query("DELETE  FROM course_tbl WHERE cou_id='$id'  ");
	if($delCourse){
		$target_dir = "../../../uploads/imgs/courses/";
		$imagePath = $target_dir. $selCou['img'];
		if (file_exists($imagePath) AND $selCou['img'] != 'default.png') {
			unlink($imagePath);
		};
		$res = array("status" => "success" , "Cou_name" => $selCou['cou_name']);
	}else{
		$res = array("status" => "failed");
	};

	echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>