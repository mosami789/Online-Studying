<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $selCourse = $conn->query("SELECT * FROM assi_tbl WHERE assi_name='$assi_name'");

 if($selCourse->rowCount() > 0)
 {
	$res = array("status" => "exist", "assi_name" => $assi_name);
 }
 else
 {
        $insCourse = $conn->query("INSERT INTO assi_tbl(assi_name, assi_description, cou_id, assi_deadline) VALUES('$assi_name','$assi_description','$id_course' ,'$deadlinedate') ");
        if($insCourse)
        {
            $res = array("status" => "success", "assi_name" => $assi_name);
        }
        else
        {
            $res = array("status" => "failed", "assi_name" => $assi_name);
        }
 };
 echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>