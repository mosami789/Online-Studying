<?php
session_start();
/** @var object $conn */
include("../conn.php");
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selstudent = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid'");
    if($selstudent->rowCount() > 0){
        $updStudent = $conn->query("UPDATE student_tbl SET stu_password ='$Stu_NewPass' WHERE stu_id='$stuid' ");
        if($updStudent){
            $delQuestion = $conn->query("DELETE  FROM reset_password WHERE order_id='$order_id'");
            $res = array("status" => "success", "stu_email" => $email);
        }else{
            $res = array("status" => "failed");
        };
    };
    echo json_encode($res);
}else{
    header("location:../index.php");
};
?>