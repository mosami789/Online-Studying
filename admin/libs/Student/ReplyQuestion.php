<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $token = $_GET["key"];
    $adminid = $_SESSION['adminid'];

    if ($token == '1'){
        $currentDate = date('Y-m-d H:i:s');
        $InsertReply = $conn->query("UPDATE stu_questions SET answer='$ReplyText' , lecturer_id='$adminid' , replied_time='$currentDate' WHERE order_id='$id' ");
    }elseif ($token == '2'){
        $InsertReply = $conn->query("UPDATE stu_questions SET answer='$ReplyText' , lecturer_id='$adminid' WHERE order_id='$id' ");
    };

    if($InsertReply)
    {
        $res = array("status" => "success");
    }else{
        $res = array("status" => "failed");
    };
    echo json_encode($res);

}else{
    header("location:../index.php");
};
?>