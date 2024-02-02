<?php
   $id = $_GET["id"];
   $CountRequests = $conn->query("SELECT * FROM course_req WHERE cou_id='$id' ORDER BY order_id desc");
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
                        <div>Course <?php echo $selCourse['cou_name'];  ?> Requests
                            <div class="page-title-subheading">
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="scrollbar-container"></div>   

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=manage-student">Manage Students</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=course-setting&id=<?php echo $_GET["id"]; ?>"><?php echo $selCourse['cou_name']; ?></a></li>
                        <li class="active breadcrumb-item" aria-current="page">Requests</li>
                    </ol>
                </nav>
                <div class="main-card mb-3 card">
                    <div class="card-header">Requests List
                    <span class="badge badge-pill badge-primary ml-2">
                              <?php echo $CountRequests->rowCount(); ?>
                        </span>
                        <div class="btn-actions-pane-right pl-">
                            <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                            <thead>
                            <tr>
                                <th class="text-left pl-4">#</th>
                                <th class="text-left pl-4">Student Name</th>
                                <th class="text-left pl-4">Student Email</th>
                                <th class="text-left pl-4">Course</th>
                                <th class="text-center" width="30%">Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                if($CountRequests->rowCount() > 0)
                                {
                                    while ($selReqRow = $CountRequests->fetch(PDO::FETCH_ASSOC)) {  $xi++; 
                                        $stuid = $selReqRow['stu_id'];
                                        $selReq = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid' ")->fetch(PDO::FETCH_ASSOC);
                                        $stuid2 = $selReqRow['cou_id'];
                                        $selReq2 = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$stuid2' ")->fetch(PDO::FETCH_ASSOC);                      
                                    ?>
                                        <tr>
                                            <th class="pl-4"scope="row">#<?php echo $xi; ?></th>    
                                            <td  class="pl-4">
                                                <a href="home.php?page=student-setting&id=<?php echo $stuid; ?>"><?php echo $selReq['stu_fullname']; ?></a>
                                            </td>
                                            <td class="pl-4">
                                                <?php echo $selReq['stu_email']; ?>
                                            </td>
                                            <td class="pl-4">
                                              <a href="home.php?page=course-setting&id=<?php echo $_GET["id"]; ?>"><?php echo $selReq2['cou_name']; ?></a>
                                            </td>
                                            <td class="text-center">
                                                <button href="#" id="AccepStudentReq" data-id='<?php echo $selReqRow['order_id']; ?>' class="mr-1 btn btn-success mb-1">Approved</button>
                                                <button type="button" data-id='<?php echo $selReqRow['order_id']; ?>'  id="deleterequestcourse"  class="mr-1 btn btn-danger mb-1">Refused</button>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Requests Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="notFound_1"  class="text-primary pl-3" style="display: none;"><legend>No result found...</legend></div>
                </div>
            </div>
            
        </div>
    </div>

<script>
// Accept Student Request 
$(document).on("click","#AccepStudentReq" , function(e){
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
      type : "post",
      url : "libs/CourseStudent/addstudentcourse.php?id=2",
      dataType : "json",  
      data : {id:id},
      cache : false,  
      success : function(data){
        if(data.status == "exist")
        {
          NotificationError(data.stuname + " Already Approved.","Already Approved!");
        }
        else if(data.status == "success")
        {
          toastr.success(data.stuname + ' has been successfully Approved.','Success');
          location.reload();
        };
      },
      error : function(xhr, ErrorStatus, error){
        console.log(status.error);
      }
    });
});

//Refuse Account Request
$(document).on("click", "#deleterequestcourse", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to refuse this request?",
			icon: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete  now!'
		}).then((result) => {
      if (result.value) {
        $.ajax({
        type : "post",
        url : "libs/CourseStudent/deletecourseReq.php",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            toastr.success(data.stuname + ' has been successfully refused.','Success');
            refreshDiv();
          };
        },
        error : function(xhr, ErrorStatus, error){
          console.log(status.error);
        }
      });
      };
    });
  return false;
});
</script>