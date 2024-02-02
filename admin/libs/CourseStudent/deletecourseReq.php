<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$selCheckCou = $conn->query("SELECT * FROM course_req WHERE order_id='$id' ")->fetch(PDO::FETCH_ASSOC);
$stuid = $selCheckCou['stu_id'];
$stu_fullname = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid' ")->fetch(PDO::FETCH_ASSOC);
$delCourse = $conn->query("DELETE  FROM course_req WHERE order_id='$id'  ");
if($delCourse)
{
	$res = array("status" => "success" , "stuname" => $stu_fullname['stu_fullname']);
}
else
{
	$res = array("status" => "failed");
};
echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>