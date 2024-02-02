<?php
$stu_id = $_SESSION['Student_ID'];
$StudentCourse = $conn->query("SELECT * FROM course_check WHERE student_id='$stu_id' ORDER BY coustu_id desc");
$PendingCourses = $conn->query("SELECT * FROM course_req WHERE stu_id='$stu_id' ORDER BY order_id desc");
?>
<div class="app-sidebar sidebar-shadow">
<div class="scrollbar-container"></div>

    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Home</li>
                <li id="myCoursesHome"> 
                    <a id="myCoursesHome2" href="home.php">
                    <i class="metismenu-icon pe-7s-home"></i>My Courses</a>
                </li>
                <li id="MyProfile"> 
                    <a id="MyProfile2" id="myCoursesHome2" href="home.php?page=profile">
                    <i class="metismenu-icon pe-7s-user"></i>Student Account</a>
                </li>
                <li class="app-sidebar__heading">Courses</li>

                <li id="AllCoursesFrm">
                    <a  href="#">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Course
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a id="AllCoursesFrm2" href="home.php?page=courses">
                                <i class="metismenu-icon"></i>
                                Courses
                            </a>
                        </li>
                        <li>
                            <a id="AllCoursesFrm3" href="home.php?page=pending">
                                <i class="metismenu-icon">
                                </i>Pending Courses
                                <?php
                                    if ($PendingCourses->rowCount() > 0){
                                    echo '<span class="badge badge-pill badge-danger p-1 ml-2">'.$PendingCourses->rowCount().'</span>';
                                    };
                                ?>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="app-sidebar__heading">My Courses</li>
                <?php
                    if($StudentCourse->rowCount() > 0){
                        while($createSideBarCourse = $StudentCourse->fetch(PDO::FETCH_ASSOC)){
                            $CouStu_ID = $createSideBarCourse['course_id'];
                            $Cours_iNFO = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$CouStu_ID'")->fetch(PDO::FETCH_ASSOC);
                            
                            //Calc. Exams
                            $CountCou_Exam = $conn->query("SELECT * FROM exam_tbl WHERE cou_id='$CouStu_ID' ORDER BY ex_id desc");
                            if ($CountCou_Exam->rowCount() > 0){
                                $i = 0;
                                while($check_exam = $CountCou_Exam->fetch(PDO::FETCH_ASSOC)){
                                    $exam_id = $check_exam['ex_id'];
                                    $StudentCheck_Exam = $conn->query("SELECT * FROM exam_check WHERE stu_id='$stu_id' AND exam_id = '$exam_id' ORDER BY order_Id desc");
                                    if ($StudentCheck_Exam->rowCount() > 0){
                                    }else{
                                        $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                        $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $check_exam['ex_deadline']);
                                        $CheckExamPost = $check_exam['posted'];
                                        if ($date2 > $date1 AND $CheckExamPost == 'yes' ) {
                                            $i++;
                                        };
                                    };
                                };
                            };
                            //Calc. Assignments
                            $CountCou_Assi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$CouStu_ID' ORDER BY assi_id desc");
                            if ($CountCou_Assi->rowCount() > 0){
                                $ii = 0;
                                while($check_Assi = $CountCou_Assi->fetch(PDO::FETCH_ASSOC)){
                                    $assi_id = $check_Assi['assi_id'];
                                    $Studentcheck_Assi = $conn->query("SELECT * FROM assi_check WHERE stu_id='$stu_id' AND assi_id = '$assi_id' ORDER BY order_id desc");
                                    if ($Studentcheck_Assi->rowCount() > 0){
                                    }else{
                                        $date1 = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                                        $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $check_Assi['assi_deadline']);
                                        $CheckAssiPost = $check_Assi['post'];
                                        if ($date2 > $date1 AND $CheckAssiPost == 'yes') {
                                            $ii++;
                                        };
                                    };
                                };
                            };
                            $noti_Num = 0;
                            $noti_Num = ($i + $ii);
                            echo '<li id="cou_'.$CouStu_ID.'">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-bookmarks"></i>
                                '.$Cours_iNFO['cou_name'];
                                if ($noti_Num > 0){
                                    echo '<span class="badge badge-pill badge-danger p-1 ml-2">'.$noti_Num.'</span>';
                                };
                                echo '<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a id="lec_'.$CouStu_ID.'" href="home.php?page=lectures&id='.$CouStu_ID.'">
                                        <i class="metismenu-icon"></i>
                                        Lectures';
                            echo'</a>
                                </li>
                                <li>
                                    <a id="exam_'.$CouStu_ID.'" href="home.php?page=exams&id='.$CouStu_ID.'">
                                        <i class="metismenu-icon">
                                        </i>Exams';              
                                            if ($i != 0){
                                                echo '<span class="badge badge-pill badge-danger p-1 ml-2">'.$i.'</span>';
                                            };
                                        
                                    echo  '</a>
                                </li>
                                <li>
                                    <a id="assi_'.$CouStu_ID.'" href="home.php?page=assignments&id='.$CouStu_ID.'">
                                        <i class="metismenu-icon">
                                        </i>Assignments';
                                        if ($ii != 0){
                                            echo '<span class="badge badge-pill badge-danger p-1 ml-2">'.$ii.'</span>';
                                        };   
                                echo' </a>
                                </li>
                            </ul>
                        </li>';
                        };
                    }else{
                        echo '<li>
                        <a href="#">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                No Courses
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a></li>';
                    };
                ?>
                <li class="app-sidebar__heading">Questions</li>
                <li>
                    <a data-toggle="modal" data-target="#addquestion" style="cursor: pointer;">
                        <i class="metismenu-icon pe-7s-help1">
                        </i>Ask a question
                    </a>
                </li>
                <li id="MyQuestionFrm" >
                    <a id="MyQuestionFrm2" href="home.php?page=myquestions">
                        <i class="metismenu-icon pe-7s-help1">
                        </i>My Questions
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>  