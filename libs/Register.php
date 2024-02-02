<?php
session_start();
 /** @var object $conn */
 include("../conn.php");
 extract($_POST);

  function validateToken($token) {
    return isset($_SESSION['token']) && $_SESSION['token'] === $token;
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    
    if (validateToken($token)) {
       $selStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_email='$Stu_Email'");
        if($selStudent->rowCount() > 0){
          $res = array("status" => "exist", "stu_email" => $Stu_Email , "token" => $token);
        }else{
              $insStudent = $conn->query("INSERT INTO student_tbl(stu_fullname, stu_gender, stu_birthdate, stu_email , stu_password , stu_phone , stu_status , stu_profile) VALUES('$Stu_name','$Stu_Gender', '$Stu_Bdate' , '$Stu_Email', '$Stu_Pass', '$Stu_Phone' ,'pending' ,'defult.jpg') ");
              if($insStudent){
                    $res = array("status" => "success", "stu_name" => $Stu_name);
                    
              }else{
                  $res = array("status" => "failed", "stu_name" => $Stu_name , "token" => $token);
              };
        };
    } else {
      $res = array("status" => "error", "msg" => "bad request" , "token" => $token);
    };
    echo json_encode($res);
  }else{
    header("location:../index.php");
  }
?>