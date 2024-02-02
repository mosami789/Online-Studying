<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if ($course == '0'){
    $res = array("status" => "empty");
}else{
    $selStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_email='$email'");

    if($selStudent->rowCount() > 0)
    {
       $res = array("status" => "exist", "stu_email" => $email);
    }
    else
    {
           $insStudent = $conn->query("INSERT INTO student_tbl(stu_fullname, stu_gender, stu_birthdate, stu_email , stu_password , stu_status , stu_phone , stu_profile) VALUES('$fullname','$gender', '$bdate' , '$email', '$password', '$status', '$phone' , 'defult.jpg') ");
           if($insStudent)
           {
                $res = array("status" => "success", "stu_name" => $fullname);
           }
           else
           {
               $res = array("status" => "failed", "stu_name" => $fullname);
           }
    };
}

 echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>