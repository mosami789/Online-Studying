<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selHeader = $conn->query("SELECT * FROM exam_question_header WHERE que_id='$id' ");
    $selHeaderRow = $selHeader->fetch(PDO::FETCH_ASSOC);

    $res = array("status" => "success", "title" => $selHeaderRow['title'], "Que_Text" => $selHeaderRow['Que_Text'], "img" => $selHeaderRow['img']);
    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>