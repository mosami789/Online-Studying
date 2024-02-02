<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selQue = $conn->query("SELECT * FROM assi_question_tbl WHERE assi_que='$question'");

    if($selQue->rowCount() > 0)
    {
        $selQue = $selQue->fetch(PDO::FETCH_ASSOC);
        if ($Que_ID == $selQue['que_assi_id']){
            $res = array("status" => "success");
            $updQuestion = $conn->query("UPDATE assi_question_tbl SET assi_que='$question', assi_ch1='$choice_A', assi_ch2='$choice_B', assi_ch3='$choice_C', assi_ch4='$choice_D', assI_qu_asnwer='$correctAnswer'  WHERE que_assi_id='$Que_ID' ");
        }else{
            $res = array("status" => "exist");
        };
    }else{
        $updQuestion = $conn->query("UPDATE assi_question_tbl SET assi_que='$question', assi_ch1='$choice_A', assi_ch2='$choice_B', assi_ch3='$choice_C', assi_ch4='$choice_D', assI_qu_asnwer='$correctAnswer'  WHERE que_assi_id='$Que_ID' ");
        $res = array("status" => "success");

    };
    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
 ?>