<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selQueReq = $conn->query("SELECT * FROM stu_questions WHERE order_id='$id'")->fetch(PDO::FETCH_ASSOC);
        $target_dir = "../../../uploads/imgs/questions/";
        $imagePath = $target_dir. $selQueReq['img'];
        if (file_exists($imagePath)) {
          unlink($imagePath);
        };
        $delQuestion = $conn->query("DELETE  FROM stu_questions WHERE order_id='$id'  ");
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
?>