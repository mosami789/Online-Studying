<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $selQue = $conn->query("SELECT * FROM assi_question_tbl WHERE assi_id='$assi_id' AND assi_que='$question'");

 if($selQue->rowCount() > 0)
 {
	$res = array("status" => "exist", "question" => $question);
 }
 else
 {
        $insQue = $conn->query("INSERT INTO assi_question_tbl(assi_id, assi_que, assi_ch1, assi_ch2, assi_ch3, assi_ch4, assI_qu_asnwer ,assi_header) VALUES('$assi_id','$question', '$choice_A','$choice_B','$choice_C','$choice_D','$correctAnswer','$QueHeaderID') ");
        if($insQue)
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