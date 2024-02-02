<?php 
session_start();
require_once('initialize.php');
include("conn.php");
$page = $_GET["page"];

$WebTitle = 'QUIZLET';

if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {

  $stuid = $_SESSION['Student_ID'];
  /** @var object $conn */
  $stu_fullname = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid' ")->fetch(PDO::FETCH_ASSOC);
  include("includepages/header.php"); 

  echo '<!-- sidebar diri  -->
  <div class="app-main">';
  include("includepages/sidebar.php");
  
  echo jsfiles;
  echo '<script type="text/javascript" src="assets/scripts/main.js"></script>';
  if ($stu_fullname['stu_status'] == 'active'){

    if ($page == ""){
      include("pages/home.php");
    }elseif ($page == "lectures"){
      include("pages/lectures/lecture.php");
    }elseif ($page == "watch"){
      include("libs/LectureVideoRequest.php");
      include("pages/lectures/watch.php");
    }elseif ($page == "exams"){
      include("pages/exams/exam.php");
    }elseif ($page == "examining"){
      include("pages/exams/start_exam.php");
    }elseif ($page == "examresult"){
      include("pages/Exams/view_exam.php");
    }elseif ($page == "profile"){
      include("pages/profile.php");
    }elseif ($page == "view"){
      include("pages/courses/view.php");
    }elseif($page == "pending"){
      include("pages/courses/pending.php");
    }elseif ($page == "courses"){
      include("pages/courses/courses.php");
    }elseif ($page == "details"){
      include("pages/courses/details.php");
    }elseif ($page == "assignments"){
      include("pages/assignments/assigments.php");
    }elseif ($page == "solving"){
      include("pages/assignments/solving.php");
    }elseif ($page == 'assiresult'){
      include("pages/assignments/result.php");
    }elseif ($page == "myquestions"){
     include("pages/questions/MyQuestions.php"); 
    }else{
      include("pages/home.php");
    };
  }else{
    if ($page == "profile"){
      include("pages/profile.php");
    }else{
      include("pages/Pending.php");
    };
  };
  
  include("includepages/footer.php");
  echo '</div></div>';
  include("includepages/models.php");

  } else {
    

    include("login-ui/includepages/header.php"); 

    echo jsfiles;
    echo '<script type="text/javascript" src="assets/scripts/main.js"></script>';
    
    echo '  <div class="app-main">';

    if ($page == ''){
      include("login-ui/index.php");
    }elseif ($page == 'login'){
      include("login-ui/login.php");
    }elseif ($page == 'register'){
      $status = 'access';
      include("libs/RequestAccess.php");
      include("login-ui/register.php");
    }elseif ($page == "forgotpassword"){
      include("login-ui/forgotpassword.php");
    }elseif ($page == "details"){
      include("login-ui/view.php");
    }elseif ($page == "Reset"){
      include("login-ui/resetpassword.php");
    }else{
      header('Location: home.php');
    };

  include("login-ui/includepages/footer.php");

    echo '</div></div>';
  };
?>

