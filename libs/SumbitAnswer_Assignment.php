<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
    /** @var object $conn */
    include("../conn.php");
    extract($_POST);
    $stu_id = $_SESSION['Student_ID'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selAssi_Check = $conn->query("SELECT * FROM assi_check WHERE stu_id='$stu_id' AND assi_id='$assi_id'");
        if ($selAssi_Check->rowCount() > 0){
            $res = array("status" => "failed_insert");
        }else{
            $insAssiCheck = $conn->query("INSERT INTO assi_check(stu_id, assi_id) VALUES('$stu_id','$assi_id') ");
            foreach ($Answer as $key[0] => $value) {
                $que_id = $key[0];
                $insAnswers = $conn->query("INSERT INTO assi_answers(stu_id, assi_id, question_id, question_answer) VALUES('$stu_id','$assi_id', '$que_id' , '$value') ");
            };
            if ($insAnswers){
                $res = array("status" => "success");
            }else{
                $res = array("status" => "failed_insert");
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