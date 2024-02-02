<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$id_check = $_GET["id"];

if ($id_check == "1"){
    //Add Course To Student from profile
    $selCou = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id_course' ");
    $selCouRow = $selCou->fetch(PDO::FETCH_ASSOC);
   if ($id_course == 0){
       $res = array("status" => "empty", "coursename" => $selCouRow['cou_name']);
   }else{
       $selCourseStudent = $conn->query("SELECT * FROM course_check WHERE student_id='$stuid' AND course_id='$id_course'");
       if($selCourseStudent->rowCount() > 0)
       {
          $res = array("status" => "exist", "coursename" => $selCouRow['cou_name']);
       }
       else
       {
              $insCourseStudent = $conn->query("INSERT INTO course_check(student_id, course_id) VALUES('$stuid','$id_course') ");
              if($insCourseStudent)
              {
                $selCourseStudentReq = $conn->query("SELECT * FROM course_req WHERE stu_id='$stuid' AND cou_id='$id_course'");
                if($selCourseStudentReq->rowCount() > 0){
                $conn->query("DELETE  FROM course_req WHERE order_id='$id'  ");
                };
                $res = array("status" => "success", "coursename" => $selCouRow['cou_name']);
              }
              else
              {
                  $res = array("status" => "failed", "coursename" => $selCouRow['cou_name']);
              };
       };
   };
}elseif ($id_check == "2"){
    //Add Course To Student from requests
    $selCheckCou = $conn->query("SELECT * FROM course_req WHERE order_id='$id' ")->fetch(PDO::FETCH_ASSOC);
    $stuid = $selCheckCou['stu_id'];
    $id_course = $selCheckCou['cou_id'];
    $stu_fullname = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid' ")->fetch(PDO::FETCH_ASSOC);
    $selCourseStudent = $conn->query("SELECT * FROM course_check WHERE student_id='$stuid' AND course_id='$id_course'");
    if($selCourseStudent->rowCount() > 0)
    {
    $res = array("status" => "exist", "stuname" => $stu_fullname['stu_fullname']);
    }
    else
    {
        $insCourseStudent = $conn->query("INSERT INTO course_check(student_id, course_id) VALUES('$stuid','$id_course') ");
        if($insCourseStudent)
        {
            $selCourseStudentReq = $conn->query("SELECT * FROM course_req WHERE stu_id='$stuid' AND cou_id='$id_course'");
            if($selCourseStudentReq->rowCount() > 0){
               $conn->query("DELETE  FROM course_req WHERE order_id='$id'  ");
            };
            $res = array("status" => "success", "stuname" => $stu_fullname['stu_fullname']);
        }
        else
        {
            $res = array("status" => "failed", "stuname" => $stu_fullname['stu_fullname']);
        }
    };
};
    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>