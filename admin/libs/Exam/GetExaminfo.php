<?php 
 /** @var object $conn */
  include("../libs/AdminSession.php");
  include("../../conn.php");
  extract($_POST);


  $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$id' ");
  $selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);


  $res = array("status" => "success", "exam_name" => $selExamRow['ex_title'], "TimeLimit" => $selExamRow['ex_time_limit'] ,"Description" => $selExamRow['ex_description'] ,"Cou_id" => $selExamRow['cou_id'] ,"Deadline" => $selExamRow['ex_deadline'] );


  echo json_encode($res);
 ?>

















