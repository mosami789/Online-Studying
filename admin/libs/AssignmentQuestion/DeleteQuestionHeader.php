<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selHeader = $conn->query("SELECT * FROM assi_question_header WHERE que_id='$id' ");
    $selHeader = $selHeader->fetch(PDO::FETCH_ASSOC);
    $SelectCase = $_GET["id"];

    if ($SelectCase == '1'){

        $target_dir = "../../../uploads/imgs/assignments/";
        $imagePath = $target_dir. $selHeader['img'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        };

        $updQuestion = $conn->query("UPDATE assi_question_header SET img=''  WHERE que_id='$id' ");
        if($updQuestion)
        {
            $res = array("status" => "success");
        }else{
            $res = array("status" => "failed", "msg" => 'Sorry, there was an error , please try again.');
        };
        
    }else{

        $delQueHeader = $conn->query("DELETE  FROM assi_question_header WHERE que_id='$id' ");
        if($delQueHeader)
        {   
            $query = $conn->query("DELETE FROM assi_question_tbl WHERE assi_header = '$id'");
            
            $target_dir = "../../../uploads/imgs/assignments/";
            $imagePath = $target_dir. $selHeader['img'];
            if (file_exists($imagePath)) {
            unlink($imagePath);
            };

            $res = array("status" => "success");
        }else{
            $res = array("status" => "failed");
        };
    };

    echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>