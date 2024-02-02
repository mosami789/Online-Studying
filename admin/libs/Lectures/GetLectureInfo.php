<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $selLec = $conn->query("SELECT * FROM lec_tbl WHERE lec_id='$id' ");
  $selLecRow = $selLec->fetch(PDO::FETCH_ASSOC);


  $res = array("status" => "success", "Lec_Id" => $selLecRow['lec_id'] ,"Lec_Title" => $selLecRow['lec_name'], "Lec_VideoLink" => $selLecRow['video_link'] ,"Lec_Description" => $selLecRow['lec_description'] , "Lec_Time" => $selLecRow['lec_time'] , "Lec_img"=> $selLecRow['img']);


  echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>
















