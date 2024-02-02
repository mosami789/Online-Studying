<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$delCourse = $conn->query("DELETE  FROM assi_question_tbl WHERE que_assi_id='$id'  ");
if($delCourse)
{
	$res = array("status" => "success");
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