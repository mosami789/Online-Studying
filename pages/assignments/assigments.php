<?php
$cou_id = $_GET["id"];
$stuid = $_SESSION['Student_ID'];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$cou_id'")->fetch(PDO::FETCH_ASSOC);
$CountCou_Assi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$cou_id' AND post='yes' ORDER BY assi_id desc");
?>
<title><?php  echo $WebTitle. ' | ' . $CourseInfo['cou_name'] . ' - Assignments'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Course <?php echo $CourseInfo['cou_name']; ?> Assignments
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="mb-3 Exam_Card-withouthover">
                    <div align="center" class="Exam_Card-header">Course Assignments
                        <span class="badge badge-pill badge-primary p-1 ml-2">
                                <?php echo $CountCou_Assi->rowCount() ?>
                        </span>
                    </div>
                    <?php
                        if ($CountCou_Assi->rowCount() > 0){
                            echo '<div class="Exam_Card-body  row">';
                            while($CreatAssi = $CountCou_Assi->fetch(PDO::FETCH_ASSOC)){
                                $CheckAssiPost = $CreatAssi['post'];
                                if ($CheckAssiPost == 'yes'){
                                    echo '
                                    <div class="Exam_Card text-center bg-dark col-md-5" >
                                        <div class="Exam_Card-header ">
                                        <h4 class="text-white text-center">'.$CreatAssi['assi_name'].'</h4>
                                        </div>
                                        <div class="Exam_Card-body">';
                                            $exam_id = $CreatAssi['assi_id'];
                                            $StudentCheck_Assi = $conn->query("SELECT * FROM assi_check WHERE stu_id='$stuid' AND assi_id = '$exam_id' ORDER BY order_Id desc");

                                            if ($StudentCheck_Assi->rowCount() > 0){
                                                $StudentCheck_Assi = $StudentCheck_Assi->fetch(PDO::ATTR_AUTOCOMMIT);
                                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $StudentCheck_Assi['end_time']);
                                                if ($date2 > $date1) {
                                                    echo '<div class="alert alert-warning" role="alert">You are now solving the assignment.</div>';
                                                    echo '<a href="home.php?page=solving&cou_id='.$cou_id.'&id='.$CreatAssi['assi_id'].'" class="btn btn-warning btn-rounded">Continue The Exam</a>';
                                                }else{
                                                    echo '
                                                    <div class="alert alert-success" role="alert">See the correct answers now!</div>';
                                                    echo '<a href="home.php?page=assiresult&cou_id='.$cou_id.'&id='.$CreatAssi['assi_id'].'" class="btn-success btn btn-rounded">View Answers</a>';
                                                };
                                            }else{
                                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $CreatAssi['assi_deadline']);
                                                if ($date2 > $date1) {
                                                    echo '<div class="alert alert-primary" role="alert">You did not solve this assignment.</div>';                      
                                                    echo '<a href="home.php?page=solving&cou_id='.$cou_id.'&id='.$CreatAssi['assi_id'].'" class="btn btn-primary btn-rounded">Solve Now</a>';
                                                }else{
                                                    echo '
                                                    <div class="alert alert-danger" role="alert">The assignment deadline has expired.</div>';
                                                    echo '<a href="#" class="btn btn-danger btn-rounded">Expired</a>';
                                                };
                                            };
                                        echo '</div>
                                        <div class="Exam_Card-footer text-muted">
                                        '.$CreatAssi['assi_created'].'
                                        </div>
                                    </div>';
                                };
                            };
                            echo '</div>';
                        }else{
                            echo '<br><h3 align="center" class="p-4">There are no assignments currently..</h3>';
                        };
                    ?>
                    <br>
                </div>
            </div>
        </div>
    </div>
