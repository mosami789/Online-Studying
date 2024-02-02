<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
 $token = $_GET["token"];
    if ($token == "student"){
        $selstudent = $conn->query("SELECT * FROM student_tbl WHERE stu_email='$email'");
        if($selstudent->rowCount() > 0){
            $selstudent2 = $conn->query("SELECT * FROM student_tbl WHERE stu_email='$email' AND stu_id='$stu_id'");
            if($selstudent2->rowCount() > 0){
                $updStudent = $conn->query("UPDATE student_tbl SET stu_fullname='$fullname' , stu_gender='$gender' , stu_birthdate='$bdate' , stu_email='$email' , stu_password ='$pass' , stu_phone='$phone' WHERE stu_id='$stu_id' ");
                if($updStudent)
                {
                      $res = array("status" => "success", "stu_email" => $email , "stu_name" => $fullname);
                }
                else
                {
                      $res = array("status" => "failed");
                };
            }else{
                $res = array("status" => "exist", "stu_email" => $email);
            }
    
        }else{
            $updStudent = $conn->query("UPDATE student_tbl SET stu_fullname='$fullname' , stu_gender='$gender' , stu_birthdate='$bdate' , stu_email='$email' , stu_password ='$pass' , stu_phone='$phone' WHERE stu_id='$stu_id' ");
            if($updStudent)
            {
                  $res = array("status" => "success", "stu_email" => $email , "stu_name" => $fullname);
            }
            else
            {
                  $res = array("status" => "failed");
            };
        };
    }elseif ($token == 'admin'){
        $updadmin = $conn->query("UPDATE admin_acc SET admin_name='$fullname' , admin_user='$user' , admin_pass='$pass' WHERE admin_id='$admin_id' ");
        if($updadmin)
        {
              $res = array("status" => "success");
        }
        else
        {
              $res = array("status" => "failed");
        };
    };

 echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>

