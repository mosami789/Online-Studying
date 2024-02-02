<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selQue = $conn->query("SELECT * FROM assi_question_tbl WHERE que_assi_id='$id' ");
    $selQueRow = $selQue->fetch(PDO::FETCH_ASSOC);

    $res = array("status" => "success", "question" => $selQueRow['assi_que'], "exam_ch1" => $selQueRow['assi_ch1'], "exam_ch2" => $selQueRow['assi_ch2'], "exam_ch3" => $selQueRow['assi_ch3'], "exam_ch4" => $selQueRow['assi_ch4'], "exam_answer" => $selQueRow['assI_qu_asnwer']);
    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>