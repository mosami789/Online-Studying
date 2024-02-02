<?php
$examid = $_GET["id"];
$stuid = $_GET["stu"];
$ExamInfo = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examid'")->fetch(PDO::FETCH_ASSOC);
$course_id = $ExamInfo["cou_id"];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$course_id'")->fetch(PDO::FETCH_ASSOC);
$selStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid' ")->fetch(PDO::FETCH_ASSOC);
$selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examid' ORDER BY eqt_id desc");
?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-plum-plate"></i>
                        </div>
                        <div>Exam <?php echo $ExamInfo['ex_title']; ?> Results - <?php echo $CourseInfo['cou_name'] ?> Course</div>
                    </div>
                 </div>
            </div>
            <div class="scrollbar-container"></div>
        </div>

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=manage-course">Manage Courses</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=course-setting&id=<?php echo $CourseInfo["cou_id"]; ?>"><?php echo $CourseInfo['cou_name'];  ?></a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=course-exam&id=<?php echo $CourseInfo["cou_id"]; ?>">Exams</a></li>
                        <li class="active breadcrumb-item" aria-current="page"><?php echo $selStudent['stu_fullname']; ?> Results</li>
                    </ol>
                </nav>
                <div class="card">
                    <div align="center" class="card-header">
                       Exam <?php echo $ExamInfo['ex_title'] ?> Results
                    </div>
                    <div class="col-md-12 card-body">
                    <?php
                    $Exam_Check = $conn->query("SELECT * FROM exam_check WHERE stu_id='$stuid' AND exam_id='$examid' ");

                    $ExamEndTime = $Exam_Check->fetch(PDO::FETCH_ASSOC);
                    $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                    $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $ExamEndTime['end_time']); 

                    if ($date2 < $date1) {
                        if ($Exam_Check->rowCount() > 0){
                            $Exam_Questions = $selQuest->rowCount();
                            $stu_degree = $ExamEndTime['exam_degree'];
                            $correc_percent = ($stu_degree/$Exam_Questions)*100; settype($correc_percent,'integer');
                            echo '<div  class="row">
                            <div align="center" class="col-md-5 grid mt-2" style="margin: auto;">
                                <div class="row p-3">
                                    <div align="center" class="p-1 col-md-12" style="margin: auto;">
                                        <h3 class="mt-2 text-dark">Exam Result Information</h3>
                                    </div>
                                    <div align="center" class="p-2" style="margin: auto;">
                                        <h4 class="mt-3 p-3 alert alert-dark" style="width: auto;">Student : '.$selStudent['stu_fullname'].'</h4>
                                        <h4 class="mt-3 p-3 alert alert-dark" style="width: auto;">Exam : '.$ExamInfo['ex_title'].'</h4>         
                                        <h4 class="mt-3 p-3 alert alert-dark" style="width: auto;">Course : '.$CourseInfo['cou_name'].'</h4>                                   
                                        <h4 class="mt-1 p-3 alert alert-primary" style="width: auto;">Score : '.$stu_degree.'/'.$Exam_Questions.'</h4>
                                        <h4 class="mt-1 p-3 alert alert-success" style="width: auto;">Percentage : '. $correc_percent.'%'.'</h4>
                                    </div>
                                    
                                </div>
                            </div>';  

                            if ($ExamInfo['show_result'] == 'yes'){

                                $Question_Header = $conn->query("SELECT * FROM exam_question_header WHERE exam_id='$examid'");
                                if ($Question_Header->rowCount() > 0){
                                    $i = 1;
                                    echo '
                                    <div align="center" class="col-md-12 mt-4" style="margin: auto;">
                                        <h2 class="p-3 grid text-dark" style="width: 300px;">Exam Answers</h2>
                                    </div>';
                                    while($create_que_header = $Question_Header->fetch(PDO::FETCH_ASSOC)){
                                        $ii++;
                                        echo '

                                        <div class="col-md-12 mt-3">
                                            <div class="card-body grid">
                                                <h2 class="text-dark">'.$ii.') '.$create_que_header['title'].'</h2>
                                            </div>
                                        ';

                                            if ($create_que_header['img'] != ""){
                                                echo '<div align="center" class="col-md-12">
                                                <img src="../uploads/imgs/exams/'.$create_que_header['img'].'" class="card-img-bottom col-md-5" alt="...">
                                            </div>';
                                            };

                                            if ($create_que_header['Que_Text'] != ""){
                                                echo '<div align="left" class="alert alert-dark col-md-11 mt-3">
                                                <h4>'.$create_que_header['Que_Text'].'</h4>
                                            </div>';
                                            };
                                            echo '</div>';
                                        $Question_Header_Id = $create_que_header['que_id'];
                                    
                                        $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.question_id WHERE eqt.exam_id='$examid' AND ea.exam_id='$examid' AND eqt.exam_header = '$Question_Header_Id' AND ea.stu_id = '$stuid' ");
                                        
                                        while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                            <div class="row col-md-12" style="margin: auto;">
                                                <div class="col-md-12">';

                                            if($selQuestRow['exam_answer'] == $selQuestRow['question_answer']){
                                                echo  '<h4 class="mt-3 alert alert-success">'.$i++.'. '.$selQuestRow['exam_question'].'</h4>
                                                <h5 class="mt-3 p-2 text-dark" style="width: auto;">Your Answer : <span class="text-success">'.$selQuestRow['question_answer'].'</span></h5>';
                                            }else{
                                                $print_answ = str_replace('Not_Selected' , 'Not Selected' , $selQuestRow['question_answer']);
                                                echo '<h4 class="mt-3 alert alert-danger">'.$i++.'. '.$selQuestRow['exam_question'].'</h4>
                                                <h5 class="mt-3 p-2 text-dark" style="width: auto;">Your Answer :   <span class="text-danger">'.$print_answ.'</span></h5>
                                                <h5 class="mt-3 p-2 text-dark" style="width: auto;">Correct Answer :  <span class="text-success">'.$selQuestRow['exam_answer'].'</span></h5>';
                                            };

                                            echo '</div></div>';
                                        };
                                    };
                                };                                       
                            };
                        }else{
                            echo '<h1 align="center" class="text-center text-danger mt-3">'.$selStudent['stu_fullname'].' have not taken this exam yet.</h1><br>';
                        };
                    }else{
                        echo '<h1 align="center" class="text-center text-danger">'.$selStudent['stu_fullname'].' have not taken this exam yet.</h1><br>';
                    };
                    ?>        
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
