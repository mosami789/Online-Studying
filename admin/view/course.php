<?php
   $id = $_GET["id"];
   $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
   $CountLec = $conn->query("SELECT * FROM lec_tbl WHERE cou_id='$id' ORDER BY lec_id desc");
   $CountStudent = $conn->query("SELECT * FROM course_check eqt INNER JOIN student_tbl ea ON eqt.student_id = ea.stu_id WHERE eqt.course_id='$id' ORDER BY coustu_id desc");
   $CountRequests = $conn->query("SELECT * FROM course_req WHERE cou_id='$id' ORDER BY order_id desc");
   $CountExams = $conn->query("SELECT * FROM exam_tbl WHERE cou_id='$id' ORDER BY ex_id desc");
   $CountAssi = $conn->query("SELECT * FROM assi_tbl WHERE cou_id='$id' ORDER BY assi_id desc");
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
                        <div>Manage Course  -  <?php echo $selCourse['cou_name'];  ?>  
                        </div>
                    </div>
                        <div class="page-title-actions">
                            <a class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-danger" href="home.php?page=course-requests&id=<?php echo $id; ?>">Requests<span class="badge badge-pill badge-light"><?php echo $CountRequests->rowCount(); ?></span></a>
                        </div>
                    </div>   
                 </div>
            </div>

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=manage-course">Manage Courses</a></li>
                        <li class="active breadcrumb-item" aria-current="page"><?php echo $selCourse['cou_name'];  ?></li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <a href="home.php?page=course-exam&id=<?php echo $id; ?>" class="btn-lg btn btn-success">Total Exams<span class="badge badge-pill badge-light"><?php echo $CountExams->rowCount(); ?> </span></a>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <a href="home.php?page=course-assignment&id=<?php echo $id; ?>" class="btn-lg btn btn-success">Total Assignments<span class="badge badge-pill badge-light"><?php echo $CountAssi->rowCount(); ?> </span></a>
                        </div> 
                    </div>  
                </div>     
            </div>

            <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-header">
                                    <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>Course Information
                                </div>
                                <div class="card-body">
                                    <form method="post" id="updateCourseFrm">
                                        <div class="form-group">
                                            <label>Course Tilte</label>
                                            <input type="hidden" name="course_id" class="form-control" value="<?php echo $id; ?>">
                                            <input type="hidden" id="CheckUploadPhotoUpdateCourse" name="CheckPhoto" value="NoPhoto">
                                            <input type="" name="newCourseName" class="form-control form-control" required="" value="<?php echo $selCourse['cou_name']; ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="cou_description" id="exampleText" class="form-control form-control" placeholder="Input Course Description" required="" autocomplete="off" style="height: 100px;"><?php echo $selCourse['cou_description']; ?></textarea>
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
                                    <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i>COURSE Students'S
                                    <span class="badge badge-pill badge-primary ml-2">
                                        <?php echo $CountStudent->rowCount();?>
                                    </span>
                                    <div class="btn-actions-pane-right">
                                        <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body">       
                                    <div class="scroll-area-sm" style="min-height: 299px;">
                                        <div class="scrollbar-container">
                                    <?php 
                                        if($CountStudent->rowCount() > 0){  ?>
                                            <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                                                <thead>
                                                <tr>
                                                    <th width="10%">#</th>
                                                    <th class="text-left pl-1">Studen Name</th>
                                                    <th class="text-center" width="35%">Profile</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    if($CountStudent->rowCount() > 0){
                                                        $xi =  0;
                                                        while ($selStudentRow = $CountStudent->fetch(PDO::FETCH_ASSOC)) { 
                                                            $xi++;
                                                            echo '<tr>
                                                            <th  scope="row">#'.$xi.'</th>
                                                                <td class="text-left pl-1">
                                                                    <div class="widget-content p-0">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left mr-3">
                                                                                <div class="widget-content-left">
                                                                                    <img width="40" class="rounded-circle" src="../uploads/imgs/profiles/'.$selStudentRow['stu_profile'].'" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-left flex2">
                                                                                <div class="widget-heading">'.$selStudentRow['stu_fullname'].'</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>  
                                                                <td class="text-center">
                                                                    <a type="button" href="home.php?page=student-setting&id='.$selStudentRow['student_id'].'" class="btn btn-success btn-sm mb-1">View</a>
                                                                </td>
                                                            </tr>';
                                                        };
                                                    }else{
                                                        echo '<tr>
                                                        <td colspan="3">
                                                            <h3 class="p-3">No Students Found<.../h3>
                                                        </td>
                                                        </tr>';
                                                    };
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="notFound_1"  class="text-primary" style="display: none;"><legend>No Students found...</legend></div>
                                        <?php }
                                        else
                                        { ?>
                                            <h4 class="text-primary">No Students found...</h4>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            </div>                                                
                        </div>
                    </div> 
                   
                     <div class="main-card mb-3 card">
                          <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Course Lectures's 
                            <span class="badge badge-pill badge-primary ml-2">
                              <?php echo $CountLec->rowCount(); ?>
                            </span>
                            <div class="btn-actions-pane-right ">
                                <input type="text" id="searchInput_2" class="form-control form-control" onkeyup="SearchTabel(2)" placeholder="Search...">
                            </div>
                          </div>
                          <div class="card-body" >
                            <div class="scroll-area-sm" style="min-height: 375px;">
                               <div class="scrollbar-container">
                            <?php 
                               
                               if($CountLec->rowCount() > 0)
                               {  ?>
                                 <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_2">
                                        <thead>
                                        <tr>
                                            <th class="text-left pl-4">#</th>
                                            <th class="text-left pl-1">Lecture Title</th>
                                            <th class="text-left pl-1">Lecture Time</th>
                                            <th class="text-left pl-1">Viewers</th>
                                            <th class="text-left pl-1">Created Time</th>
                                            <th class="text-center" width="20%">Setting</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            
                                            if($CountLec->rowCount() > 0)
                                            {
                                               $i =  $CountLec->rowCount();
                                               while ($selLectureRow = $CountLec->fetch(PDO::FETCH_ASSOC)) { 
                                                    $id2 = $selLectureRow['lec_id'];
                                                    $CountLecViewers = $conn->query("SELECT * FROM lec_timecount WHERE lec_id='$id2' ORDER BY order_id desc");
                                               ?>
                                                <tr>
                                                        <th class="pl-4"scope="row">#<?php echo $i--; ?></th>    
                                                        <td>
                                                            <b><?php echo $selLectureRow['lec_name']; ?></b><br>
                                                            <span> Video Url : <?php echo $selLectureRow['video_link']; ?></span><br>
                                                            <span> Description : <?php echo $selLectureRow['lec_description']; ?></span>
                                                        </td>
                                                        <td class="pl-1"><?php echo $selLectureRow['lec_time']; ?> Days</td>
                                                        <td class="pl-1"><?php echo $CountLecViewers->rowCount(); ?> Viewers</td>
                                                        <td class="pl-1"><?php echo $selLectureRow['lec_created']; ?></td>
                                                            <td class="text-center">
                                                            <button id="GetInfoForLecturefrm" data-toggle="modal" data-target="#modalForUpdateLecture" data-id='<?php echo $selLectureRow['lec_id']; ?>' class="btn btn-sm btn-primary mb-1">Update</button>
                                                            <button type="button" id="deletelecture" data-id='<?php echo $selLectureRow['lec_id']; ?>'  class="btn btn-danger btn-sm mb-1">Delete</button>
                                                        </td>
                                                    </tr>
                                               <?php }
                                            }
                                            else
                                            { ?>
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
                                <div id="notFound_2"  class="text-primary" style="display: none;"><legend>No Lecture found...</legend></div>
                            <?php }
                                else
                                { ?>
                                    <h4 class="text-primary">No Lecture found...</h4>
                            <?php
                                }
                            ?>
                            </div>
                        </div>

                        <div align="right" class="btn-actions-pane-right mt-3">
                            <button class="btn btn btn-primary " id="btnaddlec" data-toggle="modal" data-target="#modalForAddLecture">Add Lecture</button>
                        </div>
                        </div>
                    </div>
            </div>

    </div>


<script>
// Update Course
$(document).on("submit","#updateCourseFrm" , function(){
  $.post("libs/Course/updatecourse.php", $(this).serialize() , function(data){
     if(data.status == "success")
     {
        Notification(data.newCourseName + " Course has been successfully updated.","Success");
        document.getElementById('Close_modalForUpdateCourse').click();         
          refreshDiv();
        }
    else if(data.status == "exist")
     {
      NotificationError(data.newCourseName + "  Already Exist.","Already Exist!");
    }
  },'json')
  return false;
});
</script>