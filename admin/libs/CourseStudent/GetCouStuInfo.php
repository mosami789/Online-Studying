<?php 
 /** @var object $conn */
  include("../libs/AdminSession.php");
  include("../../conn.php");
  extract($_POST);
  $selCou = $conn->query("SELECT * FROM course_check WHERE coustu_id='$id' ")->fetch(PDO::FETCH_ASSOC);
  $id2 = $selCou['course_id'];
  $selCou2 = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id2' ")->fetch(PDO::FETCH_ASSOC);
  $res = array("status" => "success", "Cou_name" => $selCou2['cou_name']);
  echo json_encode($res);
 ?>

















