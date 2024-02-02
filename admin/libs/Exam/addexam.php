<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selCourse = $conn->query("SELECT * FROM exam_tbl WHERE ex_title='$examTitle'");
    if($selCourse->rowCount() > 0)
    {
        $res = array("status" => "exist", "examTitle" => $examTitle);
    }else{
        if ($id_course == 0){
            $res = array("status" => "empty", "examTitle" => $examTitle , "msg" => "Please Select Course First." , "title" => "Select Course") ;
        }elseif ($ResultsStatus == 0){
            $res = array("status" => "empty", "examTitle" => $examTitle , "msg" => "Please Select Show Results First" , "title" => "Select Show Results");        
        }else{
            $insCourse = $conn->query("INSERT INTO exam_tbl(ex_title, ex_time_limit , ex_description , cou_id , ex_deadline , show_result , posted) VALUES('$examTitle','$timeLimit' , '$examDesc' , '$id_course' ,'$deadlinedate', '$ResultsStatus' , 'no') ");
            if($insCourse)
            {
                $res = array("status" => "success", "examTitle" => $examTitle);
            }
            else
            {
                $res = array("status" => "failed", "examTitle" => $examTitle);
            }
        };      
    };
 echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>