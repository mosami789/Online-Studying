<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
 /** @var object $conn */
 include("../conn.php");
 extract($_POST);
$stuid = $_SESSION['Student_ID'];
$selLecReq = $conn->query("SELECT * FROM lec_timecount WHERE lec_id='$Lec_Id' AND stu_id='$stuid'");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($selLecReq->rowCount() > 0){
            $res = array("status" => "exist");
        }else{
            $currentDate = date('Y-m-d H:i:s');
            $timecount = '+'.$timecount.' days';
            $EndTime = date("Y-m-d H:i:s", strtotime($currentDate . $timecount));
            $InsertLec = $conn->query("INSERT INTO lec_timecount(lec_id, stu_id, start_time ,end_time) VALUES('$Lec_Id','$stuid','$currentDate','$EndTime') ");
            if($InsertLec)
            {
                $res = array("status" => "success");
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