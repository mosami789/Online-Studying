<?php
$cou_id = $_GET["id"];
$stuid = $_SESSION['Student_ID'];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$cou_id'")->fetch(PDO::FETCH_ASSOC);
$CountCou_Exam = $conn->query("SELECT * FROM exam_tbl WHERE cou_id='$cou_id' AND posted='yes' ORDER BY ex_id desc");
?>
<title><?php  echo $WebTitle. ' | ' . $CourseInfo['cou_name'] . ' - Exams'; ?></title>
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
                        <div>Course <?php echo $CourseInfo['cou_name']; ?> Exams
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="mb-3 Exam_Card-withouthover">
                    <div align="center" class="Exam_Card-header">Course Exams
                        <span class="badge badge-pill badge-primary p-1 ml-2">
                                <?php echo $CountCou_Exam->rowCount() ?>
                        </span>
                    </div>
                    <?php
                        if ($CountCou_Exam->rowCount() > 0){
                            echo '<div class="Exam_Card-body  row">';
                            while($CreatExam = $CountCou_Exam->fetch(PDO::FETCH_ASSOC)){
                                $CheckExamPost = $CreatExam['posted'];
                                if ($CheckExamPost == 'yes'){
                                    echo '
                                    <div class="Exam_Card text-center bg-dark col-md-5" style="height: 260px;">
                                        <div class="Exam_Card-header ">
                                        <h4 class="text-white text-center">'.$CreatExam['ex_title'].'</h4>
                                        </div>
                                        <div class="Exam_Card-body">';
                                            $exam_id = $CreatExam['ex_id'];
                                            $StudentCheck_Exam = $conn->query("SELECT * FROM exam_check WHERE stu_id='$stuid' AND exam_id = '$exam_id' ORDER BY order_Id desc");

                                            if ($StudentCheck_Exam->rowCount() > 0){
                                                $StudentCheck_Exam = $StudentCheck_Exam->fetch(PDO::ATTR_AUTOCOMMIT);
                                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $StudentCheck_Exam['end_time']);
                                                if ($date2 > $date1) {
                                                    echo '<div class="alert alert-warning" role="alert">You are now doing the exam.</div>';
                                                    echo '<a href="home.php?page=examining&cou_id='.$cou_id.'&id='.$CreatExam['ex_id'].'" class="btn btn-warning btn-rounded">Continue The Exam</a>';
                                                }else{
                                                    echo '
                                                    <div class="alert alert-success" role="alert">See your results now!</div>';
                                                    echo '<a href="home.php?page=examresult&cou_id='.$cou_id.'&id='.$CreatExam['ex_id'].'" class="btn-success btn btn-rounded">View Results</a>';
                                                };
                                            }else{
                                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $CreatExam['ex_deadline']);
                                                if ($date2 > $date1) {
                                                    echo '<div class="alert alert-primary" role="alert">You have not taken this exam.</div>';                      
                                                    echo '<a href="home.php?page=examining&cou_id='.$cou_id.'&id='.$CreatExam['ex_id'].'" class="btn btn-primary btn-rounded">Exam Now</a>';
                                                }else{
                                                    echo '
                                                    <div class="alert alert-danger" role="alert">The exam deadline has expired.</div>';
                                                    echo '<a href="#" class="btn btn-danger btn-rounded">Expired</a>';
                                                };
                                            };
                                        echo '</div>
                                        <div class="Exam_Card-footer text-muted">
                                        '.$CreatExam['ex_created'].'
                                        </div>
                                    </div>';
                                }else{
                                    echo '<h3 align="center" class="p-3 col-md-12">There are no exams currently..</h3>';
                                };
                            };
                            echo '</div>';
                        }else{
                            echo '<br><h3 align="center" class="p-4">There are no exams currently..</h3>';
                        };
                    ?>
                    <br>
                </div>
            </div>
        </div>
    </div>
