<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

       if ($cou_id == 0){
              $cou_id = $olc_Coud_id;
       };

       $CheckExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_title='$examTitle' AND cou_id='$cou_id' ");

       if ($exam_Status == ''){
              if ($CheckExam->rowCount() > 0){
                     $CheckExam = $CheckExam->fetch(PDO::FETCH_ASSOC);
                     if ($CheckExam['ex_id'] == $examId){
                            $updExam2 = $conn->query("UPDATE exam_tbl SET ex_title='$examTitle' ,cou_id='$cou_id', ex_description='$examDesc' , ex_time_limit='$timeLimit' , ex_deadline='$deadlinedate' , show_result = '$ResultsStatus' WHERE ex_id='$examId' ");
                            if($updExam2)
                            {
                                   $res = array("status" => "success", "examTitle" => $examTitle);
                            }else{
                                   $res = array("status" => "failed");
                            };
                     }else{
                            $res = array("status" => "exist" , "examTitle" => $examTitle);

                     };
              }else{
                     $updExam2 = $conn->query("UPDATE exam_tbl SET ex_title='$examTitle' ,cou_id='$cou_id', ex_description='$examDesc' , ex_time_limit='$timeLimit' , ex_deadline='$deadlinedate' , show_result = '$ResultsStatus' WHERE ex_id='$examId' ");
                     if($updExam2)
                     {
                            $res = array("status" => "success", "examTitle" => $examTitle);
                     }else{
                            $res = array("status" => "failed");
                     };
              };
       }else{
              $CheckExam2 = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
              $updExam2 = $conn->query("UPDATE exam_tbl SET posted='$exam_Status' WHERE ex_id='$examId' ");
              if($updExam2)
              {
                     $res = array("status" => "success", "examTitle" => $CheckExam2['ex_title'] , "exam_Status" => $exam_Status);
              }else{
                     $res = array("status" => "failed");
              };
       };
       
 echo json_encode($res);
}else{
       header("location: ../../../index.php");
};
?>