<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$delAssi = $conn->query("DELETE  FROM assi_tbl WHERE assi_id='$id'  ");
if($delAssi)
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