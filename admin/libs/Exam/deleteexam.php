<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$examinfo = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$id' ")->fetch(PDO::FETCH_ASSOC);;
$delExam = $conn->query("DELETE  FROM exam_tbl WHERE ex_id='$id' ");
if($delExam)
{
	$res = array("status" => "success", "Exam_Name" => $examinfo['ex_title']);
}
else
{
	$res = array("status" => "failed");
}
	echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>