<?php
   $CountRequests = $conn->query("SELECT * FROM student_tbl WHERE stu_status='pending' ORDER BY stu_id desc");
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
                        <div>Student Requests
                            <div class="page-title-subheading">
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="scrollbar-container"></div>   

            <div class="col-md-13">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php?page=manage-student">Manage Students</a></li>
                        <li class="active breadcrumb-item" aria-current="page">Requests</li>
                    </ol>
                </nav>
                <div class="main-card mb-4 card">
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
                                <th class="text-left pl-4">Fullname</th>
                                <th class="text-left pl-4">Email</th>
                                <th class="text-left pl-4">Gender</th>
                                <th class="text-left pl-4">Birhdate</th>
                                <th class="text-left pl-4">Joining Time</th>
                                <th class="text-left pl-4">status</th>
                                <th class="text-center" width="30%">Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                if($CountRequests->rowCount() > 0)
                                {
                                    while ($selReqRow = $CountRequests->fetch(PDO::FETCH_ASSOC)) {  $xi++; ?>
                                        <tr>
                                            <th class="pl-4"scope="row">#<?php echo $xi; ?></th>    
                                            <td  class="pl-4">
                                                <a href="home.php?page=student-setting&id=<?php echo $selReqRow['stu_id']; ?>"><?php echo $selReqRow['stu_fullname']; ?></a>
                                            </td>
                                            <td class="pl-4">
                                                <?php echo $selReqRow['stu_email']; ?>
                                            </td>
                                            <td class="pl-4"><?php echo $selReqRow['stu_gender']; ?></td>
                                           <td class="pl-4"><?php echo $selReqRow['stu_birthdate']; ?></td>
                                           <td class="pl-4"><?php echo $selReqRow['created_time']; ?></td>
                                            <td class="pl-4">
                                                <div class="badge badge-warning">Pending</div>
                                            </td>
                                            <td class="text-center">
                                                <button href="#" id="AcceptStudentReq" data-id='<?php echo $selReqRow['stu_id']; ?>' class="mr-1 btn btn-sm btn-success mb-1">Approved</button>
                                                <button type="button" data-id='<?php echo $selReqRow['stu_id']; ?>' id="refusestudent"  class="mr-1 btn btn-sm btn-danger mb-1">Refused</button>
                                                <button type="button" data-id='<?php echo $selReqRow['stu_id']; ?>' id="deletestudent"  class="mr-1 btn btn-sm btn-danger mb-1">Delete Account</button>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="8">
                                        <h3 class="p-3">No Students Found</h3>
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
//Accept Account Request
$(document).on("click","#AcceptStudentReq" , function(e){
  e.preventDefault();
  var id = $(this).data("id");
  $.ajax({
    type : "post",
    url : "libs/Student/acceptstudent.php",
    dataType : "json",  
    data : {id:id},
    cache : false,  
    success : function(data){
      if(data.status == "success")
      {
        toastr.success(data.stuname + ' has been successfully Approved.','Success');
        refreshDiv();
      }
    },
    error : function(xhr, ErrorStatus, error){
      console.log(status.error);
    }
  });
});

//Refuse Account Request
$(document).on("click", "#refusestudent", function(e){
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
        url : "libs/Student/refusestudent.php",
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

//Delete Account
$(document).on("click", "#deletestudent", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this account?",
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
        url : "libs/Student/deletestudent.php",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            toastr.success(data.stuname + ' has been successfully deleted.','Success');
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