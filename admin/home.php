<?php 
session_start();
require_once('initialize.php');
$WebTitle = 'QUIZLET';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {

  include("../conn.php");
include("includepages/header.php"); 
 
 echo '<!-- sidebar diri  -->
 <div class="app-main">';

 include("includepages/sidebar.php");

echo '<script type="text/javascript" src="../assets/scripts/main.js"></script>';
echo jsfiles;

$page = $_GET["page"];

  if ($page == ""){
    include("pages/home.php");
  }elseif ($page == "manage-course"){
    include("pages/managecourse.php");
  }elseif ($page == "course-setting"){
    include("view/course.php");
  }elseif ($page == 'manage-exam'){
    include("pages/manageexam.php");
  }elseif ($page == 'exam-setting'){
    include("view/exam-info.php");
  }elseif ($page == 'user-setting'){
    include("profile/index.php");
  }elseif ($page == 'manage-assignment'){
    include("pages/manageassignments.php");
  }elseif ($page == 'assignment-setting'){
    include('view/assignment-info.php');
  }elseif ($page == 'manage-student'){
    include("pages/managestudent.php");
  }elseif ($page == 'student-setting'){
    include("profile/profile.php");
  }elseif ($page == 'web-setting'){
    include("pages/websetting.php");
  }elseif ($page == 'course-requests'){
    include("requests/course.php");
  }elseif ($page == "course-exam"){
    include("view/course-exam.php");
  }elseif ($page == 'course-assignment'){
    include("view/course-assignment.php");
  }elseif ($page == 'student-requests'){
    include("requests/student.php");
  }elseif ($page == 'exam-questions'){
    include("view/exam-questions.php");
  }elseif ($page == 'assignment-questions'){
    include("view/assignment-questions.php");
  }elseif ($page == 'exam-results'){
    include("view/exam-results.php");
  }elseif ($page == 'assignment-answers'){
    include("view/assignment-answers.php");
  }elseif ($page == 'student-questions'){
    include("view/student-questions.php");
  }elseif ($page == 'view-questions'){
    include("view/ViewQuestion.php");
  };
  
  include("../includepages/footer.php");
  echo '</div></div>';
  include("includepages/modals.php");

  if ($page == "manage-course"){
    include("modals/course.php");
  }elseif ($page == "course-setting"){
    include("modals/lecture.php");
  }elseif ($page == 'exam-questions'){
    include("modals/ExamQue.php");
  }elseif ($page == 'assignment-questions'){
    include("modals/AssignmentQue.php");
  }elseif ($page == 'student-setting'){
    include("modals/StuCourse.php");
  }elseif ($page == 'course-exam'){
    include("modals/CourseExam.php");
  }elseif ($page == 'course-assignment'){
    include("modals/CourseAssignment.php");
  };

  } else {
 
    include("login-ui/includepages/header.php"); 
    echo jsfiles;
    echo '<script type="text/javascript" src="../assets/scripts/main.js"></script>';
    
    echo '  <div class="app-main">';
    include("login-ui/login.php");

    include("login-ui/includepages/footer.php");

    echo '</div></div>';
  };

?>

