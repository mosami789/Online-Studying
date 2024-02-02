<div class="app-sidebar sidebar-shadow">
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
            
                <li class="app-sidebar__heading">Dashboards</li>
                
                <li id="AdminDashboard"> 
                    <a id="AdminDashboard2" href="home.php">
                    <i class="metismenu-icon pe-7s-home"></i>Admin Dashboard</a>
                </li>

                <li id="MyProfile"> 
                    <a id="MyProfile2" href="home.php?page=user-setting&id=<?php echo $_SESSION['adminid']; ?>">
                    <i class="metismenu-icon pe-7s-user"></i>Profile</a>
                </li>
                
                <li id="WebSetting"> 
                    <a id="WebSetting2" href="home.php?page=web-setting">
                    <i class="metismenu-icon pe-7s-config"></i>Setting</a>
                </li>

                <li class="app-sidebar__heading">MANAGE SYSTEM</li>
 
                <li id="managecourse1">
                    <a href="#">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Course
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a id="btnaddcourse" href="#" data-toggle="modal" data-target="#modalForAddCourse">
                                <i class="metismenu-icon"></i>
                                Add Course
                            </a>
                        </li>
                        <li >
                            <a id="managecourse2" href="home.php?page=manage-course">
                                <i class="metismenu-icon">
                                </i>Manage Course
                            </a>
                        </li>
                        
                    </ul>
                </li>
                
                <li id="manageexam1">
                    <a href="#">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Exam
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a id="btnaddExam" href="#" data-toggle="modal" data-target="#modalForExam">
                                <i class="metismenu-icon"></i>
                                Add Exam
                            </a>
                        </li>
                        <li>
                            <a id="manageexam2" href="home.php?page=manage-exam">
                                <i class="metismenu-icon">
                                </i>Manage Exam
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li id="assignment1">
                    <a href="#">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Assignment
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a id="btnaddassi" href="#" data-toggle="modal" data-target="#modalForAddeAssignments">
                                <i class="metismenu-icon"></i>
                                Add Assignment
                            </a>
                        </li>
                        <li>
                            <a id="assignment2" href="home.php?page=manage-assignment">
                                <i class="metismenu-icon">
                                </i>Manage Assignments
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li id="student1">
                    <a href="#">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Students
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="" data-toggle="modal" data-target="#modalForAddExaminee">
                            Add Student
                            </a>
                        </li>
                        <li>
                            <a id="student2" href="home.php?page=student-requests">
                                <i class="metismenu-icon pe-7s-users">
                                </i>Requests
                            </a>
                        </li>
                        <li>
                            <a id="student2" href="home.php?page=manage-student">
                                <i class="metismenu-icon pe-7s-users">
                                </i>Manage Students
                            </a>
                        </li>
                    </ul>
                </li>

                <li id="Stu_Que"> 
                    <a id="Stu_Que2" href="home.php?page=student-questions">
                    <i class="metismenu-icon pe-7s-help1"></i>Student Questions</a>
                </li>
                
                <li class="app-sidebar__heading">Courses</li>
                <?php $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC "); 
                    if ($selCourse->rowcount() > 0){
                        while($Course_SideBar = $selCourse->fetch(PDO::FETCH_ASSOC)){

                            $id_Req = $Course_SideBar['cou_id'];
                            $CountRequests = $conn->query("SELECT * FROM course_req WHERE cou_id='$id_Req' ORDER BY order_id desc");
                            if ($CountRequests->rowCount() > 0){
                                $notireq = '<span class="ml-2 badge badge-pill badge-danger">'.$CountRequests->rowCount().'</span>';
                            }else{
                                $notireq= '';
                            };

                            echo '
                            <li id="Cou_'.$Course_SideBar['cou_id'].'">
                              
                                <a href="#">
                                        <i class="metismenu-icon pe-7s-bookmarks"></i>
                                        '.$Course_SideBar['cou_name'].$notireq.'
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a id="Req_'.$Course_SideBar['cou_id'].'" href="home.php?page=course-requests&id='.$Course_SideBar['cou_id'].'">
                                            <i class="metismenu-icon">
                                            </i>Requests'.$notireq.'
                                        </a>
                                    </li>
                                    <li>
                                        <a id="Lec_'.$Course_SideBar['cou_id'].'" href="home.php?page=course-setting&id='.$Course_SideBar['cou_id'].'">
                                            <i class="metismenu-icon">
                                            </i>Manage
                                        </a>
                                    </li>
                                    <li>
                                        <a id="Exam_'.$Course_SideBar['cou_id'].'" href="home.php?page=course-exam&id='.$Course_SideBar['cou_id'].'">
                                            <i class="metismenu-icon">
                                            </i>Exams
                                        </a>
                                    </li>
                                    <li>
                                        <a id="Assi_'.$Course_SideBar['cou_id'].'" href="home.php?page=course-assignment&id='.$Course_SideBar['cou_id'].'">
                                            <i class="metismenu-icon">
                                            </i>Assignments
                                        </a>
                                    </li>
                                </ul>
                         
                            </li>  ';
                        };
                    }else{

                    };
                ?>                
            </ul>
        </div>
    </div>
</div>  