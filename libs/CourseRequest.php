<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
 /** @var object $conn */
 include("../conn.php");
 extract($_POST);
$stuid = $_SESSION['Student_ID'];
$selCouReq = $conn->query("SELECT * FROM course_req WHERE cou_id='$Cou_Id' AND stu_id='$stuid'");
$Cou_Info = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$Cou_Id' ")->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if($selCouReq->rowCount() > 0)
        {
          $res = array("status" => "exist", "Cou_name" => $Cou_Info['cou_name']);
        }
        else
        {
              $insCourse = $conn->query("INSERT INTO course_req(cou_id, stu_id) VALUES('$Cou_Id','$stuid') ");
              if($insCourse){
                    $res = array("status" => "success", "Cou_name" => $Cou_Info['cou_name']);
              }else{
                  $res = array("status" => "failed", "Cou_name" => $Cou_Info['cou_name']);
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