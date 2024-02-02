<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
    /** @var object $conn */
    include("../conn.php");
    extract($_POST);
    $stu_id = $_SESSION['Student_ID'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selExamReq = $conn->query("SELECT * FROM exam_check WHERE exam_id='$Exam_id' AND stu_id='$stu_id'");
        if ($selExamReq->rowCount() > 0){
            $res = array("status" => "exist");
        }else{
            $currentDate = date('Y-m-d H:i:s');
            $timecount = '+'.$timecount.' minutes';
            $EndTime = date("Y-m-d H:i:s", strtotime($currentDate . $timecount));
            $InsertLec = $conn->query("INSERT INTO exam_check(exam_id, stu_id, start_time ,end_time , exam_degree) VALUES('$Exam_id','$stu_id','$currentDate','$EndTime' , 0) ");
            if($InsertLec)
            {
                $GetExam_Questions = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$Exam_id'");  
                while($InsertAnswer = $GetExam_Questions->fetch(PDO::FETCH_ASSOC)){
                    $Que_id = $InsertAnswer['eqt_id'];
                    $CheckFond_Answer = $conn->query("SELECT * FROM exam_answers WHERE question_id='$Que_id' AND stu_id='$stu_id' AND exam_id='$Exam_id'");
                    if ($CheckFond_Answer->rowCount() > 0){
                        //Stop Insert
                    }else{
                        $InsertExamAnswer = $conn->query("INSERT INTO exam_answers(exam_id, stu_id, question_id ,question_answer) VALUES('$Exam_id','$stu_id','$Que_id','Not_Selected') ");
                    };
                };
                $res = array("status" => "success");
            }else{
                $res = array("status" => "failed");
            };
        };
        echo json_encode($res);
    }else{
        header("location:../index.php");
    };
}else{
    header("location:../index.php");
};
?>