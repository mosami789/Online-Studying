<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$selCou = $conn->query("SELECT * FROM course_check WHERE coustu_id='$id' ")->fetch(PDO::FETCH_ASSOC);
	$id2 = $selCou['course_id'];
	$selCou2 = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id2' ")->fetch(PDO::FETCH_ASSOC);

	$delCourse = $conn->query("DELETE  FROM course_check WHERE coustu_id='$id'");
	if($delCourse)
	{
		$res = array("status" => "success" ,"couname" => $selCou2['cou_name']);
	}else{
		$res = array("status" => "failed");
	};

	echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>