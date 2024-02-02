<?php 
   $exId = $_GET['id'];
   $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exId' ");
   $StudenCourseCheck = $conn->query("SELECT * FROM exam_check eqt INNER JOIN student_tbl ea ON eqt.stu_id = ea.stu_id WHERE eqt.exam_id='$exId' ORDER BY exam_degree desc");
   $selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);
   $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exId' ORDER BY eqt_id desc");
   $id = $selExamRow['cou_id'];
   $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
 ?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon"><i class="pe-7s-config icon-gradient bg-plum-plate"></i></div>
                        <div>Exam  -  <?php echo $selExamRow['ex_title'];  ?></div>
                    </div>
                    <div class="page-title-actions">
                    <?php
                        if ($selExamRow['posted'] == 'no' or $selExamRow['posted'] = ''){
                            echo '<div data-id="'.$exId.'" data-status="yes" id="ExamStatus" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-primary">Show Exam</div>';
                        }else{
                            echo '<div data-id="'.$exId.'" data-status="no" id="ExamStatus" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-danger">Hide Exam</div>';
                        };
                    ?>
                    </div>
                </div>   
            </div>

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=manage-course">Manage Courses</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=course-setting&id=<?php echo $selCourse["cou_id"]; ?>"><?php echo $selCourse['cou_name'];  ?></a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=course-exam&id=<?php echo $selCourse["cou_id"]; ?>">Exams</a></li>
                        <li class="active breadcrumb-item" aria-current="page"><?php echo $selExamRow['ex_title']; ?></li>
                    </ol>
                </nav>
                <div class="row">

                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-header">
                                <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Exam Information
                            </div>
                            <div class="card-body">
                                <form method="post" id="updateExamFrm">
                                <div class="form-group">
                                    <label>Exam Title</label>
                                    <input type="hidden" name="examId" value="<?php echo $selExamRow['ex_id']; ?>">
                                    <input id="examTitle" name="examTitle" class="mb-2 form-control form-control" required="" value="<?php echo $selExamRow['ex_title']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Course</label>
                                    <input type="hidden" name="olc_Coud_id" value ="<?php echo $selExamRow['cou_id']; ?>">
                                    <select class="mb-2 form-control form-control"  name="cou_id" id="ExamUpdateCourse">
                                    <?php 
                                        $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id desc");
                                        $cou_id = $selExamRow['cou_id'];
                                        $selCourse2 = $conn->query("SELECT * FROM course_tbl WHERE cou_id ='$cou_id' ")->fetch(PDO::FETCH_ASSOC);
                                        echo '<option value="0">'.$selCourse2['cou_name'].'</option>';
                                        while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)){

                                            if ($selCourseRow['cou_id'] != $cou_id){
                                                echo '<option value="'.$selCourseRow['cou_id'].'">'.$selCourseRow['cou_name'].'</option>';
                                            };
                                        };
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Show Results</label>
                                    <select class="mb-2 form-control form-control"  name="ResultsStatus">
                                    <?php
                                        $ResultsStatus = $selExamRow['show_result'];
                                        if ($ResultsStatus == 'yes' ){
                                            echo '
                                            <option value="yes">Enable</option>
                                            <option value="no">Disable</option>';
                                        }else{
                                            echo '
                                            <option value="no">Disable</option>
                                            <option value="yes">Enable</option>';
                                        };
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>DeadLine</label>
                                    <input type="date" name="deadlinedate" class="form-control" required="" placeholder="Input DeadLine" autocomplete="off" value="<?php $date = new DateTime($selExamRow['ex_deadline']);$formattedDate = $date->format("Y-m-d"); echo $formattedDate; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Exam Time Limit (Minutes)</label>
                                    <input name="timeLimit" type="number" class="mb-2 form-control form-control" placeholder="Input Exam Time Limit" required="" value="<?php echo $selExamRow['ex_time_limit']; ?>">
                                </div>
                                    <div class="form-group">
                                    <label>Exam Description</label>
                                    <input type="" name="examDesc" class="mb-2 form-control form-control" required="" value="<?php echo $selExamRow['ex_description']; ?>">
                                </div> 
                                    <div class="form-group" align="right">
                                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                    </div> 
                                </form>                           
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Exam Results'S
                                <span class="badge badge-pill badge-primary ml-2">
                                <?php echo $StudenCourseCheck->rowCount(); ?>
                                </span>
                                <div class="btn-actions-pane-right">
                                    <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body">       
                                <div class="scroll-area-sm" style="height: 580px;">
                                    <div class="scrollbar-container">
                                        <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">#</th>
                                                        <th class="text-left pl-1">Studen Name</th>
                                                        <th class="text-left pl-1">Sscore</th>
                                                        <th class="text-center" width="35%">Answers</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                if($StudenCourseCheck->rowCount() > 0){
                                                    $xi =  0;
                                                    while ($selStudentRow = $StudenCourseCheck->fetch(PDO::FETCH_ASSOC)) { 
                                                        $xi++;
                                                        echo '<tr>
                                                        <th scope="row">#'.$xi.'</th>
                                                            <td class="text-left pl-1">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left mr-3">
                                                                            <div class="widget-content-left">
                                                                                <img width="40" class="rounded-circle" src="../uploads/imgs/profiles/'.$selStudentRow['stu_profile'].'" alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="widget-content-left flex2">
                                                                            <div class="widget-heading"><a href="home.php?page=student-setting&id='.$selStudentRow['stu_id'].'">'.$selStudentRow['stu_fullname'].'</a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>  
                                                            <td class="text-center">'.$selStudentRow['exam_degree'].'/'.$selQuest->rowCount().'</td>
                                                            <td class="text-center">
                                                                <a type="button" href="home.php?page=exam-results&id='.$exId.'&stu='.$selStudentRow['stu_id'].'&course='.$id.'" class="btn btn-success btn-sm mb-1">View Answers</a>
                                                            </td>
                                                        </tr>';
                                                    };
                                                }else{
                                                    echo '<tr>
                                                    <td colspan="4">
                                                        <h3 class="p-3">No Students Found</h3>
                                                    </td>
                                                    </tr>';
                                                };
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="notFound_1"  class="text-primary" style="display: none;"><legend>No Students found...</legend></div>
                                    </div>
                                </div>
                            </div>
                            </div>                                                
                    </div>

                </div>  
            </div>
             
        </div>
    </div>
 
        
<script>
//Update Exam
$(document).on("submit","#updateExamFrm" , function(){
  $.post("libs/Exam/updateexam.php", $(this).serialize() , function(data){
     if(data.status == "success")
     {
          Notification(data.examTitle + " Exam has been Successfully updated.","Success");
          refreshDiv();   
     }
     else if(data.status == "empty"){
       NotificationError("Please Select Course First.","Select Course");
      }
      else if(data.status == "exist")
      {
        NotificationError(data.examTitle + " Exam Already Exist.","Already Exist!");
      }
    },'json')
    return false;
});

//Hide , Show Exam
$(document).on("click", "#ExamStatus", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  var status = $(this).data("status");
  var status_msg
    if (status == "yes"){
        status_msg = "show";
    }else{
        status_msg = "hide";
    }
    Swal.fire({
        title: 'You want to ' + status_msg + ' exam for students?',
        icon: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, '+ status_msg +'  now!'
		}).then((result) => {
      if (result.value) {
        $.ajax({
        type : "post",
        url : "libs/Exam/updateexam.php",
        dataType : "json",  
        data : {exam_Status:status ,examId:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            if (data.exam_Status == "yes"){
                toastr.success('Exam has been shown for students.','Success');
            }else{
                toastr.success('Exam has been hidden for students.','Success');
            }
            refreshDiv();
          }else{
            NotificationError("There's an error ,please try again!","Already Exist!");
          };
        },
        error : function(xhr, ErrorStatus, error){
          console.log(status.error);
        }
      });
      };
    });

});
</script>