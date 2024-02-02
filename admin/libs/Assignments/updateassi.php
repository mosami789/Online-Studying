<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_GET["id"];

    if ($id == '1'){

        $selAssi = $conn->query("SELECT * FROM assi_tbl WHERE assi_name='$assi_name'");

        if ($cou_id == 0){
            $cou_id = $old_cou_id;
        };
    
        function Update_Assi($conn , $assi_name , $cou_id , $assi_desc , $assi_deadline , $assi_id){
            $updAssi = $conn->query("UPDATE assi_tbl SET assi_name='$assi_name' ,cou_id='$cou_id' ,assi_description='$assi_desc', assi_deadline='$assi_deadline' WHERE assi_id='$assi_id' ");    
            if ($updAssi){
                $res = array("status" => "success" , "assi_name" => $assi_name);
            }else{
                $res = array("status" => "failed" , "assi_name" => $assi_name);
            };
            return json_encode($res);
        };
    
        if($selAssi->rowCount() > 0){
            $selAssi = $selAssi->fetch(PDO::FETCH_ASSOC);
            $course_id = $selAssi['cou_id'];
            
            if ($course_id == $old_cou_id){
                
             echo (Update_Assi($conn , $assi_name , $cou_id , $assi_desc , $assi_deadline , $assi_id));
            }else{
                $res = array("status" => "exist", "assi_name" => $assi_name);
                echo json_encode($res);
            };
        }else{
            echo (Update_Assi($conn , $assi_name , $cou_id , $assi_desc , $assi_deadline , $assi_id));
        };


    }elseif ($id == '2'){

        $selAssi = $conn->query("UPDATE assi_tbl SET post ='$status' WHERE assi_id ='$assi_id'");
        $assi_name = $conn->query("SELECT * FROM assi_tbl WHERE assi_id='$assi_id'")->fetch(PDO::FETCH_ASSOC);

        if ($selAssi){
            $res = array("status" => "success" , "assi_name" => $assi_name['assi_name']);
        }else{
            $res = array("status" => "failed" , "assi_name" => $assi_name['assi_name']);
        };
        echo json_encode($res);
    };

}else{
    header("location: ../../../index.php");
};
?>