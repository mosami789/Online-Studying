<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selQue = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_question='$question'");

    if($selQue->rowCount() > 0)
    {
        $selQue = $selQue->fetch(PDO::FETCH_ASSOC);
        if ($Que_ID == $selQue['eqt_id']){
            $updQuestion = $conn->query("UPDATE exam_question_tbl SET exam_question='$question', exam_ch1='$choice_A', exam_ch2='$choice_B', exam_ch3='$choice_C', exam_ch4='$choice_D', exam_answer='$correctAnswer'  WHERE eqt_id='$Que_ID' ");
            $res = array("status" => "success");
        }else{
            $res = array("status" => "exist");
        };
    }else{
        $updQuestion = $conn->query("UPDATE exam_question_tbl SET exam_question='$question', exam_ch1='$choice_A', exam_ch2='$choice_B', exam_ch3='$choice_C', exam_ch4='$choice_D', exam_answer='$correctAnswer'  WHERE eqt_id='$Que_ID' ");
        $res = array("status" => "success");

    };
    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
 ?>