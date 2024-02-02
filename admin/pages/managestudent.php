<?php
   $CountStudent = $conn->query("SELECT * FROM student_tbl WHERE stu_status='active' ORDER BY stu_id desc");
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
                        <div>Manage Students
                        </div>
                    </div>
                    <div class="page-title-actions">
                    <a href="home.php?page=student-requests" class="mb-0 col-md-10 mr-5 pl-3 btn-lg btn btn-danger">Requests<span class="badge badge-pill badge-light"><?php echo $CountRequests->rowCount(); ?></span></a>
                        </div>
                    </div>   
                 </div>
                 <div class="scrollbar-container"></div>
            </div>

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="active breadcrumb-item" aria-current="page">Manage Students</li>
                    </ol>
                </nav>
                <div class="main-card mb-3 card">
                    <div class="card-header">Student List
                        <span class="badge badge-pill badge-primary ml-2">
                            <?php echo $CountStudent->rowCount();?>
                        </span>
                        <div class="btn-actions-pane-right">
                            <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                            <thead>
                            <tr>
                                <th class="text-left pl-4">#</th>
                                <th class="text-left pl-4">Fullname</th>
                                <th class="text-left pl-5">Email</th>
                                <th class="text-left pl-0">Gender</th>
                                <th class="text-left pl-4">Birhdate</th>
                                <th class="text-left pl-4">Joining Time</th>
                                <th class="text-left pl-4">status</th>
                                <th class="text-center" width="20%">Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExmne = $conn->query("SELECT * FROM student_tbl WHERE stu_status='active' ORDER BY stu_id DESC ");
                                if($selExmne->rowCount() > 0)
                                {
                                    while ($selStuRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { $ix++; ?>
                                        <tr>
                                           <td class="pl-4">#<?php echo $ix; ?></td>
                                           <td class="pl-4"><?php echo $selStuRow['stu_fullname']; ?></td>
                                           <td class="pl-5"><?php echo $selStuRow['stu_email']; ?></td>
                                           <td class="pl-0"><?php echo $selStuRow['stu_gender']; ?></td>
                                           <td class="pl-4"><?php echo $selStuRow['stu_birthdate']; ?></td>
                                           <td class="pl-4"><?php echo $selStuRow['created_time']; ?></td>
                                           <td class="pl-4"><div class="badge badge-success"><?php echo $selStuRow['stu_status']; ?></div></td>
                                           <td class="text-center">
                                               <a href="home.php?page=student-setting&id=<?php echo $selStuRow['stu_id']; ?>" class="mr-1 btn btn-sm btn-success mb-2">View</a>
                                               <button type="button" data-id='<?php echo $selStuRow['stu_id']; ?>' id="deletestudent" class="mr-1 btn btn-sm btn-danger mb-2">Delete</button>
                                           </td>
                                        </tr>
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
                                        <h3 class="p-3">No Course Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                        </tbody>
                    </table>
                </div>
                <div id="notFound_1"  class="pl-3 text-primary" style="display: none;"><legend>No Student found...</legend></div>
            </div>
            
        </div> 
    </div>   

<script>
//Delete Student Account
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