<?php 
 /** @var object $conn */
 include("../AdminSession.php");
 include("../../../conn.php");
 extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $selLec = $conn->query("SELECT * FROM lec_tbl WHERE lec_id='$id' ")->fetch(PDO::FETCH_ASSOC);;
  $selLecRow = $conn->query("DELETE  FROM lec_tbl WHERE lec_id='$id'  ");

  if($selLecRow){
    $target_dir = "../../../uploads/imgs/lectures/";
      $imagePath = $target_dir. $selLec['img'];
      if (file_exists($imagePath) AND $selLec['img'] != 'defult.png') {
        unlink($imagePath);
      };

    $res = array("status" => "success" ,"Lec_name" => $selLec['lec_name']);
  }else{
    $res = array("status" => "failed");
  };

	echo json_encode($res);
}else{
  header("location: ../../../index.php");
};
?>