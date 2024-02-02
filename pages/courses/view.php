<?php 
$course_id = $_GET["id"];
$CourseInfo = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$course_id'")->fetch(PDO::FETCH_ASSOC);
$CountCou_Lec = $conn->query("SELECT * FROM lec_tbl WHERE cou_id='$course_id' ORDER BY lec_id desc");
$CountCou_Stu = $conn->query("SELECT * FROM course_check WHERE course_id='$course_id' AND student_id='$stuid' ORDER BY coustu_id desc")->fetch(PDO::FETCH_ASSOC);
$adminlecid = $CourseInfo['admin_created'];
$GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);
$CountCou_Exam = $conn->query("SELECT * FROM exam_tbl WHERE cou_id='$course_id' ORDER BY ex_id desc"); 
$CountCou_Assi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$course_id' ORDER BY assi_id desc");
?>
<title><?php  echo $WebTitle. ' | Course : '. $CourseInfo['cou_name']; ?></title>

<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-bookmarks icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Course <?php echo $CourseInfo['cou_name'] ?> details
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div align="center" class="row">
                    <div class="col-md-4">
                        <div class="mb-3 grid">
                            <div class="Exam_Card-header">
                                Lecturer
                            </div>
                            <div class="Exam_Card-body">
                                <h6><?php echo $GetAdminInfo['admin_name']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 grid">
                            <div class="Exam_Card-header">
                                Date
                            </div>
                            <div  class="Exam_Card-body">
                                <h6><?php echo $CourseInfo['cou_created']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 grid">
                            <div class="Exam_Card-header">
                            Date of joining
                            </div>
                            <div class="Exam_Card-body">
                               <h6><?php echo $CountCou_Stu['joining_time']; ?></h6>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="mb-3 grid">
                            <p align="center" class="Exam_Card-header">Course Lectures<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $CountCou_Lec->rowCount();?></span></p>      
                            <div class="Exam_Card-body">
                                <div class="scroll-area-sm" style="min-height: 315px;">
                                    <div class="scrollbar-container ps">
                                        <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList2">
                                                <thead>
                                                <tr>
                                                    <th class="text-left">Title</th>
                                                    <th class="text-left">Date</th>
                                                    <th class="text-center" width="20%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if ($CountCou_Lec->rowCount() > 0){
                                                    while ($CreateLec = $CountCou_Lec->fetch(PDO::FETCH_ASSOC)){
                                                        echo '<tr>';
                                                        echo '<td class="" ><span>'.$CreateLec['lec_name'].'</span></td>';
                                                        $lec_id = $CreateLec['lec_id'];
                                                        $StudentCheck_Lecture = $conn->query("SELECT * FROM lec_timecount WHERE stu_id='$stuid' AND lec_id = '$lec_id' ORDER BY order_id desc");
                                                        if ($StudentCheck_Lecture->rowCount() > 0){
                                                            $GetLecCheckInfo = $StudentCheck_Lecture->fetch(PDO::FETCH_ASSOC);
                                                            echo '<td class="">'.$CreateLec['lec_created'].'</td>';
                                                            $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                            $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $GetLecCheckInfo['end_time']); 
                                                            if ($date2 > $date1) {
                                                                echo '<td align="center"><a type="button" href="home.php?page=watch&id='.$lec_id.'" class="btn btn-sm btn-warning">Continue</a></td>';
                                                            }else{
                                                                echo '<td align= "center"><button type="button" class="btn btn-sm btn-danger">Expired</button></td>';
                                                            };
                                                        }else{
                                                            echo '<td class="">'.$CreateLec['lec_created'].'</td>';
                                                            if ($CreateLec['lec_time'] == 0){
                                                                echo '<td align="center"><a type="button" href="home.php?page=watch&id='.$lec_id.'" class="btn btn-sm btn-success">Watch</a></td>';
                                                            }else{
                                                                echo '<td align="center"><a type="button" href="home.php?page=watch&id='.$lec_id.'" class="btn btn-sm btn-success">Watch</a></td>';
                                                            };
                                                        };
                                                        echo '</tr>';
                                                    };
                                                }else{
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <h3 class="p-1">There are no lectures yet..</h3>
                                                    </td>
                                                </tr>';
                                                };
                                                ?>
                                                </tbody>            
                                            </table>  
                                        </div>
                                        <div id="notFound2" class="text-primary" style="display: none;"><legend>No Lecture found...</legend></div>
                                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 grid">
                            <p align="center" class="Exam_Card-header">Course Exams<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $CountCou_Exam->rowCount();?></span></p>      
                            <div class="Exam_Card-body">
                                <div class="scroll-area-sm" style="min-height: 315px;">
                                    <div class="scrollbar-container ps">
                                        <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList2">
                                                <thead>
                                                <tr>
                                                    <th class="text-left">Title</th>
                                                    <th class="text-left">Score</th>
                                                    <th class="text-center" width="20%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if ($CountCou_Exam->rowCount() > 0){
                                                    while($Exam_Creat = $CountCou_Exam->fetch(PDO::FETCH_ASSOC)){
                                                        $CheckExamPost = $Exam_Creat['posted'];
                                                        if ($CheckExamPost == 'yes'){
                                                            $exam_id = $Exam_Creat['ex_id'];
                                                            $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exam_id' ORDER BY eqt_id desc");
                                                            echo '<tr>';
                                                            echo '<td><span>'.$Exam_Creat['ex_title'].'</span></td>';
                                                            $examid = $Exam_Creat['ex_id'];
                                                            $StudentCheck_Exam = $conn->query("SELECT * FROM exam_check WHERE stu_id='$stuid' AND exam_id = '$examid' ORDER BY order_id desc");
                                                            if ($StudentCheck_Exam->rowCount() > 0){
                                                                $StudentCheck_Exam = $StudentCheck_Exam->fetch(PDO::ATTR_AUTOCOMMIT);
                                                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $StudentCheck_Exam['end_time']);
                                                                if ($date2 > $date1) {
                                                                    echo '<td><span class="mb-2 mr-2 badge badge-danger">None</span></td>';
                                                                    echo '<td align="center"><a href="home.php?page=examining&id='.$Exam_Creat['ex_id'].'" class="btn btn-warning btn-sm btn-rounded">Continue</a>';
                                                                }else{
                                                                    $exam_score = $StudentCheck_Exam['exam_degree'].'/'.$selQuest->rowCount();
                                                                    echo '<td><span class="mb-2 mr-2 badge badge-info p-2">'.$exam_score.'</span></td>';
                                                                    echo '<td align="center"><a href="home.php?page=examresult&id='.$Exam_Creat['ex_id'].'" class="btn-success btn btn-sm btn-rounded">View Results</a>';
                                                                };
                                                            }else{
                                                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $Exam_Creat['ex_deadline']);
                                                                echo '<td><span class="mb-2 mr-2 badge badge-danger">None</span></td>';
                                                                if ($date2 > $date1) {
                                                                    echo '<td align="center"><a href="home.php?page=examining&id='.$Exam_Creat['ex_id'].'" class="btn btn-primary btn-sm btn-rounded">Exam Now</a></td>';
                                                                }else{
                                                                    echo '<td align="center"><a href="#" class="btn btn-danger btn-sm btn-rounded">Expired</a></td>';
                                                                };
                                                            };
                                                            echo '</tr>';
                                                        };
                                                    };
                                                }else{
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <h3 class="p-1">There are no exams yet..</h3>
                                                    </td>
                                                </tr>';
                                                };
                                                ?>
                                                </tbody>            
                                            </table>  
                                        </div>
                                        <div id="notFound2" class="text-primary" style="display: none;"><legend>No Exam found...</legend></div>
                                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-md-6" style="margin: auto;">
                        <div class="mb-3 grid">
                            <p align="center" class="Exam_Card-header">Course Assignments<span class="badge badge-pill badge-primary p-1 ml-2"><?php echo $CountCou_Assi->rowCount();?></span></p>      
                            <div class="Exam_Card-body">
                                <div class="scroll-area-sm" style="min-height: 315px;">
                                    <div class="scrollbar-container ps">
                                        <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList2">
                                                <thead>
                                                <tr>
                                                    <th class="text-left">Title</th>
                                                    <th class="text-left">Date</th>
                                                    <th class="text-center" width="20%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    if ($CountCou_Assi->rowCount() > 0){
                                                        while($Assi_Creat = $CountCou_Assi->fetch(PDO::FETCH_ASSOC)){
                                                            $CheckAssiPost = $Assi_Creat['post'];
                                                            if ($CheckAssiPost == 'yes'){
                                                                echo '<tr>';
                                                                echo '<td><span>'.$Assi_Creat['assi_name'].'</span></td>';
                                                                echo '<td class="">'.$Assi_Creat['assi_created'].'</td>';

                                                                $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                                                $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $Assi_Creat['assi_deadline']);
                                                                $assi_id = $Assi_Creat['assi_id'];

                                                                if ($date2 > $date1){
                                                                    $CheckAssi = $conn->query("SELECT * FROM assi_check WHERE assi_id='$assi_id' AND stu_id='$stuid'");
                                                                    if ($CheckAssi->rowCount() > 0){
                                                                        echo '<td align="center"><a href="home.php?page=assiresult&id='.$assi_id.'" class="btn-success btn btn-sm btn-rounded">View Answers</a>';                                                    
                                                                    }else{
                                                                        echo '<td align="center"><a href="home.php?page=solving&id='.$assi_id.'" class="btn-primary btn btn-sm btn-rounded">Solve Now</a>';                                                    
                                                                    };
                                                                }else{
                                                                    echo '<td align="center"><a href="#" class="btn btn-danger btn-sm btn-rounded">Expired</a></td>';
                                                                };
                                                            };
                                                        };
                                                    }else{
                                                        echo '<tr>
                                                        <td colspan="4">
                                                        <h3 class="p-1">There are no assignments yet..</h3>
                                                        </td>
                                                    </tr>';
                                                    };
                                                ?>
                                                </tbody>            
                                            </table>  
                                        </div>
                                        <div id="notFound2" class="text-primary" style="display: none;"><legend>No Assignment found...</legend></div>
                                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
