<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selQue = $conn->query("SELECT * FROM exam_question_tbl WHERE eqt_id='$id' ");
    $selQueRow = $selQue->fetch(PDO::FETCH_ASSOC);

    $res = array("status" => "success", "question" => $selQueRow['exam_question'], "exam_ch1" => $selQueRow['exam_ch1'], "exam_ch2" => $selQueRow['exam_ch2'], "exam_ch3" => $selQueRow['exam_ch3'], "exam_ch4" => $selQueRow['exam_ch4'], "exam_answer" => $selQueRow['exam_answer']);
    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>