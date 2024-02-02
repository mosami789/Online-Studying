<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
    /** @var object $conn */
    include("../conn.php");
    extract($_POST);
    $stu_id = $_SESSION['Student_ID'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      foreach ($Answer as $key[0] => $value) {
          $InsertExamAnswer = $conn->query("UPDATE exam_answers SET question_answer='$value'WHERE exam_id='$exam_id' AND stu_id ='$stu_id' AND question_id='$key[0]'");
      };
      
      $i = 0;
      $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.question_id WHERE eqt.exam_id='$exam_id' AND ea.exam_id='$exam_id' AND ea.stu_id = '$stu_id' ");
      while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)){
        if($selQuestRow['exam_answer'] == $selQuestRow['question_answer']){
          $i++;
        };
      };

      $currentDate = date('Y-m-d H:i:s');
      $updExamCheck = $conn->query("UPDATE exam_check SET end_time='$currentDate' , exam_degree='$i' WHERE exam_id='$exam_id' AND stu_id='$stu_id' ");
        if ($updExamCheck){
          $res = array("status" => "success");
        }else{
          $res = array("status" => "failed_examcheck");
        };

      echo json_encode($res);
    }else{
      header("location:../index.php");
    };
}else{
  header("location:../index.php");
};
?>