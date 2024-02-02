<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {


extract($_POST);

$selstu = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$id' ")->fetch(PDO::FETCH_ASSOC);
$delStu = $conn->query("DELETE  FROM student_tbl WHERE stu_id='$id'  ");
if($delStu)
{
	$res = array("status" => "success" , "stuname" => $selstu['stu_fullname']);
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