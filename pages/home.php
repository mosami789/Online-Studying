<?php
$stuid = $_SESSION['Student_ID'];
$StudentCourse = $conn->query("SELECT * FROM course_check WHERE student_id='$stuid' ORDER BY coustu_id desc");
?>
<title><?php  echo $WebTitle. ' | Home'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-home icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Welcome Back , <?php echo $stu_fullname['stu_fullname'] ?>
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="Exam_Card-withouthover">
                    <p align="center" class="Exam_Card-header">My Courses<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $StudentCourse->rowCount();?></span></p> 
                    <div class="Exam_Card-body">     
                    <?php
                        if($StudentCourse->rowCount() > 0){
                            echo '<div class="row">';
                            while($Cou_Create = $StudentCourse->fetch(PDO::FETCH_ASSOC)){
                                $CouStu_ID = $Cou_Create['course_id'];
                                $Cours_iNFO = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$CouStu_ID'")->fetch(PDO::FETCH_ASSOC);
                                echo '<div align="center" class="Exam_Card bg-dark" style="width: 270px">
                                <img class="Exam_Card-img-top" src="uploads/imgs/courses/'.$Cours_iNFO['img'].'" style="height: 210px;" alt="'.$Cours_iNFO['cou_name'].'">
                                <div class="Exam_Card-body">
                                <h5 class="Exam_Card-title text-white">'.$Cours_iNFO['cou_name'].'</h5>
                                <a href="home.php?page=view&id='.$Cours_iNFO['cou_id'].'" class="btn-success btn btn-rounded mt-2">View Details</a>
                                </div>
                                <div class="Exam_Card-footer text-muted">
                                '.$Cours_iNFO['cou_created'].'
                                </div>
                            </div>
                                ';
                            }
                            echo '</div>';
                        }else{
                            echo '<h1 align="center" class="">You are not participating in any courses.</h1>';
                        };
                    ?>   
                    </div>
                </div>
            </div>
        </div>
    </div>
