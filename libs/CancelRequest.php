<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
/** @var object $conn */
include("../conn.php");
extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $delQuestion = $conn->query("DELETE  FROM course_req WHERE order_id='$id'  ");
        if($delQuestion)
        {
            $res = array("status" => "success");
        }else{
            $res = array("status" => "failed");
        };
        echo json_encode($res);
    }else{
        header("location:../index.php");
    };
} else {
  header("location:../index.php");
};
?>