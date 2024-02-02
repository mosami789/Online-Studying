<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selCou = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ");
  $selCouRow = $selCou->fetch(PDO::FETCH_ASSOC);
  $res = array("status" => "success", "Cou_name" => $selCouRow['cou_name'], "Cou_description" => $selCouRow['cou_description'] , "img" => $selCouRow['img']);
  echo json_encode($res);
}else{
    header("location: ../../../index.php");
};
?>

















