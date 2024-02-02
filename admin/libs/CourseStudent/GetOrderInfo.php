<?php 
 /** @var object $conn */
  include("../libs/AdminSession.php");
  include("../../conn.php");
  extract($_POST);

    if ($id == '0'){
        $selStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$studentid' ")->fetch(PDO::FETCH_ASSOC);
        $res = array("status" => "success", "studentname" => $selStudent['stu_fullname']);
    }else{
        $selOrder = $conn->query("SELECT * FROM course_req WHERE order_id='$id' ")->fetch(PDO::FETCH_ASSOC);
        $id2 = $selOrder['stu_id'];
        $selStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$id2' ")->fetch(PDO::FETCH_ASSOC);
        $res = array("status" => "success", "studentname" => $selStudent['stu_fullname']);
    };
  echo json_encode($res);
 ?>

















