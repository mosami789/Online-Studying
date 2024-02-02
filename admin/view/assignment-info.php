<?php 
   $assi_id = $_GET['id'];
   $selAssi = $conn->query("SELECT * FROM assi_tbl WHERE assi_id='$assi_id' ");
   $selAssiRow = $selAssi->fetch(PDO::FETCH_ASSOC);
   $StudenAssiCheck = $conn->query("SELECT * FROM assi_check eqt INNER JOIN student_tbl ea ON eqt.stu_id = ea.stu_id WHERE eqt.assi_id='$assi_id' ORDER BY order_id desc");
   $id = $selAssiRow['cou_id'];
   $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
 ?>

<div class="app-main__outer">
  <div id="refreshData">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-config icon-gradient bg-plum-plate">
                        </i>
                    </div>
                    <div>Manage Assignment - <?php echo $selAssiRow['assi_name']; ?></div>
                </div>
                <div class="page-title-actions">
                    <?php
                        if ($selAssiRow['post'] == 'no' or $selAssiRow['post'] = ''){
                            echo '<div data-id="'.$assi_id.'" data-status="yes" id="AssiStatus" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-primary">Show Assignment</div>';
                        }else{
                            echo '<div data-id="'.$assi_id.'" data-status="no" id="AssiStatus" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-danger">Hide Assignment</div>';
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
                  <li class="breadcrumb-item"><a href="home.php?page=course-assignment&id=<?php echo $selCourse["cou_id"]; ?>">Assignments</a></li>
                  <li class="active breadcrumb-item" aria-current="page"><?php echo $selAssiRow['assi_name'] ?></li>
              </ol>
            </nav>
            <div class="row">

              <div class="col-md-6">
                  <div class="main-card mb-3 card">
                      <div class="card-header">
                        <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Assignment Information
                      </div>
                      <div class="card-body">
                        <form method="post" id="updateAssiFrm">
                          <div class="form-group">
                            <label>Assignment Title</label>
                            <input type="hidden" name="assi_id" value="<?php echo $selAssiRow['assi_id']; ?>">
                            <input name="assi_name" class="mb-2 form-control form-control" required="" value="<?php echo $selAssiRow['assi_name']; ?>">
                          </div>
                          <div class="form-group">
                            <label>Course</label>
                            <input type="hidden" name="old_cou_id" class="mb-2 form-control form-control" value="<?php echo $selAssiRow['cou_id'];  ?>" required="" autocomplete="off">
                            <select class="mb-2 form-control form-control"  name="cou_id">
                            <?php 
                            $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id desc");
                            $cou_id = $selAssiRow['cou_id'];
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
                            <label>Assignment Description</label>
                            <input name="assi_desc" class="mb-2 form-control form-control" required="" value="<?php echo $selAssiRow['assi_description']; ?>">
                          </div>  
                          <div class="form-group">
                            <label>DeadLine</label>
                            <input type="date" name="assi_deadline" class="form-control" required="" placeholder="Input Birhdate" autocomplete="off" value="<?php $date = new DateTime($selAssiRow['assi_deadline']);$formattedDate = $date->format("Y-m-d"); echo $formattedDate; ?>">
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
                    <div class="card-header">
                        <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Student Assignment
                        <span class="badge badge-pill badge-primary ml-2">
                          <?php echo $StudenAssiCheck->rowCount(); ?>
                        </span>
                        <div class="btn-actions-pane-right">
                            <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                        </div>
                    </div>
                    <div class="card-body">       
                        <div class="scroll-area-sm" style="height: 408px;">
                            <div class="scrollbar-container">
                            
                              <div class="table-responsive">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                                    <thead>
                                    <tr>
                                        <th width="20%">#</th>
                                        <th class="text-left pl-1">Student Name</th>
                                        <th width="30%">Answers</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if($StudenAssiCheck->rowCount() > 0){
                                        $xi =  0;
                                        while ($selStudentRow = $StudenAssiCheck->fetch(PDO::FETCH_ASSOC)) { 
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
                                                <td class="">
                                                    <a type="button" href="home.php?page=assignment-answers&id='.$assi_id.'&stu='.$selStudentRow['stu_id'].'&course='.$id.'" class="btn btn-success btn-sm mb-1">View Answers</a>
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
//Update Assignment
$(document).on("submit","#updateAssiFrm" , function(){
  $.post("libs/Assignments/updateassi.php?id=1", $(this).serialize() , function(data){
     if(data.status == "success"){
          Notification(data.assi_name + " Assignment has been Successfully updated.","Success");
          refreshDiv();   
     }else if(data.status == "empty"){
       NotificationError("Please Select Course First.","Select Course");
      }else if(data.status == "exist"){
        NotificationError(data.assi_name + " Assignment Already Exist.","Already Exist!");
      }
    },'json')
    return false;
});

//Hide , Show Exam
$(document).on("click", "#AssiStatus", function(e){
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
        title: 'You want to ' + status_msg + ' assignment for students?',
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
        url : "libs/Assignments/updateassi.php?id=2",
        dataType : "json",  
        data : {status:status ,assi_id:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            if (status == "yes"){
                toastr.success('Assignment has been shown for students.','Success');
            }else{
                toastr.success('Assignment has been hidden for students.','Success');
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