<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
/** @var object $conn */
include("../conn.php");
extract($_POST);
$stuid = $_SESSION['Student_ID'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selstudent = $conn->query("SELECT * FROM student_tbl WHERE stu_email='$email'");
        $selstudentSession = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid'");
        if($selstudent->rowCount() > 0){
            $selstudentSession = $selstudentSession->fetch(PDO::FETCH_ASSOC);
            if ($selstudentSession['stu_email'] == $email){
                $updStudent = $conn->query("UPDATE student_tbl SET stu_fullname='$fullname' , stu_gender='$gender' , stu_birthdate='$bdate' , stu_email='$email' , stu_password ='$pass' , stu_phone='$phone' WHERE stu_id='$stuid' ");
                $res = array("status" => "success", "stu_email" => $email , "stu_name" => $fullname);
            }else{
                $res = array("status" => "exist", "stu_email" => $email);
            };
        }else{
            $updStudent = $conn->query("UPDATE student_tbl SET stu_fullname='$fullname' , stu_gender='$gender' , stu_birthdate='$bdate' , stu_email='$email' , stu_password ='$pass' , stu_phone='$phone' WHERE stu_id='$stuid' ");
            if($updStudent)
            {
                $res = array("status" => "success", "stu_email" => $email , "stu_name" => $fullname);
            }else{
                $res = array("status" => "failed");
            };
        };
        echo json_encode($res);
    }else{
        header("location:../index.php");
    };
} else {
  header("location:../index.php");
};
?>