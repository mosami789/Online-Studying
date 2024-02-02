<?php
$cou_id = $_GET["id"];
$stuid = $_SESSION['Student_ID'];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$cou_id'")->fetch(PDO::FETCH_ASSOC);
$CountCou_Lec = $conn->query("SELECT * FROM lec_tbl WHERE cou_id='$cou_id' ORDER BY lec_id desc");
?>
<title><?php  echo $WebTitle. ' | ' . $CourseInfo['cou_name'] . ' - Lectures'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-play icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Course <?php echo $CourseInfo['cou_name']; ?> Lectures
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="mb-3 Exam_Card-withouthover">
                    <div align="center" class="Exam_Card-header">Course Lectures<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $CountCou_Lec->rowCount() ?></span></div>
                    <div class="Exam_Card-body">
                    <?php
                    if ($CountCou_Lec->rowCount() > 0){
                        echo '<div class="row">';
                        
                        while($Lec_Create = $CountCou_Lec->fetch(PDO::FETCH_ASSOC)){
                            $lec_id = $Lec_Create['lec_id'];
                            $StudentCheck_Lecture = $conn->query("SELECT * FROM lec_timecount WHERE stu_id='$stuid' AND lec_id = '$lec_id' ORDER BY order_id desc");
                            $GetLecCheckInfo = $StudentCheck_Lecture->fetch(PDO::FETCH_ASSOC);

                            echo '<div  align="center" class="Exam_Card mt-3 bg-dark" style="width: 280px">
                            <img class="Exam_Card-img-top" src="uploads/imgs/lectures/'.$Lec_Create['img'].'" alt="'.$Lec_Create['lec_description'].'" style="height: 280px;">
                            <div class="card-body">
                                <h5 class="card-title text-white">'.$Lec_Create['lec_name'].'</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="bg-dark list-group-item text-white">'.$Lec_Create['lec_created'].'</li>
                            </ul>
                            <div class="card-body">';

                            if ($StudentCheck_Lecture->rowCount()){      
                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $GetLecCheckInfo['end_time']); 
                                if ($date2 > $date1) {
                                    echo '<a href="home.php?page=watch&cou_id='.$cou_id.'&id='.$Lec_Create['lec_id'].'" class="btn-warning btn btn-rounded">Continue watching</a>';
                                }else{
                                    echo '<button class="btn-danger btn btn-rounded">Expired</button>';
                                };
                            }else{
                                echo '<a href="home.php?page=watch&cou_id='.$cou_id.'&id='.$Lec_Create['lec_id'].'" class="btn-success btn btn-rounded">Watch</a>';
                            };

                            echo '</div></div>';

                        };
                        echo '</div><br>';
                    }else{
                        echo '<h3 align="center" class="p-4">There are no lectures currently.</h3>';
                    }
                    ?>  
                </div>
            </div>
        </div>
    </div>
    </div>
