<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $stu_fullname = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$id' ")->fetch(PDO::FETCH_ASSOC);
        $updCourse = $conn->query("UPDATE student_tbl SET stu_status='active' WHERE stu_id='$id' ");
        if($updCourse)
        {
            $res = array("status" => "success", "stuname" => $stu_fullname['stu_fullname']);
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


