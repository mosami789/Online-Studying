<?php 
$selStudent = $conn->query("SELECT COUNT(stu_id) as totStudents FROM student_tbl ")->fetch(PDO::FETCH_ASSOC);
$selExam = $conn->query("SELECT COUNT(ex_id) as totExam FROM exam_tbl ")->fetch(PDO::FETCH_ASSOC);
$selAssi = $conn->query("SELECT COUNT(assi_id) as totAssi FROM assi_tbl ")->fetch(PDO::FETCH_ASSOC);
$sellec = $conn->query("SELECT COUNT(lec_id) as totlec FROM lec_tbl ")->fetch(PDO::FETCH_ASSOC);
$selStu_Questions = $conn->query("SELECT COUNT(order_id) as totque FROM stu_questions ")->fetch(PDO::FETCH_ASSOC);
$selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC ");
$CountRequests = $conn->query("SELECT * FROM student_tbl WHERE stu_status='pending' ORDER BY stu_id desc");
 ?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon"><i class="pe-7s-home icon-gradient bg-plum-plate"></i></div>
                        <div>Admin Dashboard
                            <div class="page-title-subheading">Welcome Back Sir, <?php echo $_SESSION['adminname']; ?></div>
                        </div>
                    </div>
                    <div class="page-title-actions">
                        <a href="home.php?page=student-requests" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-danger">Student Requests<span class="badge badge-pill badge-light"><?php echo $CountRequests->rowCount(); ?></span></a>
                    </div>
                </div>
            </div>
            <div class="scrollbar-container"></div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="no-gutters row">
                        <div class="col-md-4">
                            <div class="pt-0 pb-0 card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Total Students</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-numbers text-success"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $selStudent['totStudents'] ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Total Courses</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-numbers text-primary"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $selCourse->rowCount(); ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pt-0 pb-0 card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Total Exams</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-numbers text-danger"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $selExam['totExam'] ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Total Assignments</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-numbers text-warning"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $selAssi['totAssi'] ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pt-0 pb-0 card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Total Lectures</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-numbers text-dark"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $sellec['totlec'] ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Student Questions</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-numbers text-info"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $selStu_Questions['totque']; ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Total Courses 
                        <div class="btn-actions-pane-right ">
                            <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                        </div>
                    </div>
                    <div class="card-body" >
                        <div class="scroll-area-sm" style="min-height: 375px;">
                            <div class="scrollbar-container">
                            <?php 
                                if($selCourse->rowCount() > 0)
                                {  ?>
                                    <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                                        <thead>
                                        <tr>
                                            <th class="text-left pl-4">#</th>
                                            <th class="text-left pl-1">Course</th>
                                            <th class="text-center pl-1">Total Students</th>
                                            <th class="text-center pl-1">Total Lectures</th>
                                            <th class="text-center pl-1">Total Exams</th>
                                            <th class="text-center pl-1">Total Assignments</th>
                                            <th class="text-center" width="20%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            
                                            if($selCourse->rowCount() > 0){
                                                $i =  1;
                                                while ($selLectureRow = $selCourse->fetch(PDO::FETCH_ASSOC)) {
                                                    $id = $selLectureRow['cou_id'];
                                                    $CountStudent = $conn->query("SELECT * FROM course_check eqt INNER JOIN student_tbl ea ON eqt.student_id = ea.stu_id WHERE eqt.course_id='$id' ORDER BY coustu_id desc");    
                                                    $CountLec = $conn->query("SELECT * FROM lec_tbl WHERE cou_id='$id' ORDER BY lec_id desc");
                                                    $CountExams = $conn->query("SELECT * FROM exam_tbl WHERE cou_id='$id' ORDER BY ex_id desc");
                                                    $CountAssi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$id' ORDER BY assi_id desc");
                                                ?>
                                                <tr>
                                                    <th class="pl-4"scope="row">#<?php echo $i++; ?></th>    
                                                    <td style="font-size: 20px;" class="pl-1"><?php echo $selLectureRow['cou_name']; ?></td>
                                                    <td align="center"><div class="mb-2 mr-2 alert alert-dark p-2" style="font-size: 20px;"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $CountStudent->rowCount(); ?></span></div></td>
                                                    <td align="center"><div class="mb-2 mr-2 alert alert-danger p-2" style="font-size: 20px;"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $CountLec->rowCount(); ?></span></div></td>
                                                    <td align="center"><div class="mb-2 mr-2 alert alert-success p-2" style="font-size: 20px;"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $CountExams->rowCount(); ?></span></div></td>
                                                    <td align="center"><div class="mb-2 mr-2 alert alert-info p-2" style="font-size: 20px;"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $CountAssi->rowCount(); ?></span></div></td>
                                                    <td class="text-center"><a href="home.php?page=course-setting&id=<?php echo $id; ?>" class="btn btn-primary mb-1">Manage</a></td>
                                                </tr>
                                                <?php }
                                            }else{ ?>
                                                <tr>
                                                    <td colspan="2">
                                                    <h3 class="p-3">No Course Found...</h3>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>            
                                    </table>  
                                </div>
                                <div id="notFound_1"  class="text-primary" style="display: none;"><legend>No Course found...</legend></div>
                                <?php }
                                    else
                                    { ?>
                                        <h4 class="text-primary">No Course found...</h4>
                                <?php
                                    }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Highest 10 Lectures Viewers 
                    </div>
                    <div class="card-body" >
                        <div class="scroll-area-sm" style="min-height: 375px;">
                            <div class="scrollbar-container">
                            <?php 
                                if($selCourse->rowCount() > 0)
                                {  ?>
                                    <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_2">
                                        <thead>
                                        <tr>
                                            <th class="text-left pl-4">#</th>
                                            <th class="text-left pl-1">Lecture</th>
                                            <th class="text-left pl-1">Course</th>
                                            <th class="text-center pl-1">Viewers</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            
                                            $selLecture2 = $conn->query("SELECT lec_id, COUNT(*) AS total FROM lec_timecount GROUP BY lec_id ORDER BY total DESC LIMIT 10");
                                            if($selLecture2->rowCount() > 0){
                                                $i =  1;

                                                while ($selLectureRow = $selLecture2->fetch(PDO::FETCH_ASSOC)) {
                                                    $lec_id = $selLectureRow['lec_id'];
                                                    $Lec_Info = $conn->query("SELECT * FROM lec_tbl WHERE lec_id='$lec_id'")->fetch(PDO::FETCH_ASSOC);
                                                    $Cou_id = $Lec_Info['cou_id'];
                                                    $Get_Cou = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$Cou_id'")->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <tr>
                                                    <th class="pl-4"scope="row">#<?php echo $i++; ?></th>    
                                                    <td style="font-size: 17px;" class="pl-1"><?php echo $Lec_Info['lec_name']; ?></td>
                                                    <td style="font-size: 16px;" class="pl-1"><?php echo $Get_Cou['cou_name']; ?></td>
                                                    <td align="center"><div class="mb-2 mr-2 alert alert-info p-1"><span class="timer counter alt-font appear" data-to="1500" data-speed="7000"><?php echo $selLectureRow['total']; ?></span></div></td>
                                                </tr>
                                                <?php }
                                            }else{ ?>
                                                <tr>
                                                    <td colspan="2">
                                                    <h3 class="p-3">No Lecture Found...</h3>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>            
                                    </table>  
                                </div>
                                <?php }
                                    else
                                    { ?>
                                        <h4 class="text-primary">No Lecture found...</h4>
                                <?php
                                    }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


<script>
$(document).ready(function() {
    $('.counter').each(function () {
    $(this).prop('Counter',0).animate({
    Counter: $(this).text()
    }, {
    duration: 1000,
    easing: 'swing',
    step: function (now) {
        $(this).text(Math.ceil(now));
    }
    });
    }); 
});
</script>

