<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $selCourse = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' AND exam_question='$question'");

 if($selCourse->rowCount() > 0)
 {
	$res = array("status" => "exist", "question" => $question);
 }
 else
 {
        $insCourse = $conn->query("INSERT INTO exam_question_tbl(exam_id, exam_question, exam_ch1, exam_ch2, exam_ch3, exam_ch4, exam_answer ,exam_header) VALUES('$examId','$question', '$choice_A','$choice_B','$choice_C','$choice_D','$correctAnswer','$QueHeaderID') ");
        if($insCourse)
        {
            $res = array("status" => "success", "question" => $question);
        }
        else
        {
            $res = array("status" => "failed", "question" => $question);
        }
 };
 echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>