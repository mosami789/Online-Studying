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
                        <div>Manage Settings
                        </div>
                    </div>
                    </div>   
                 </div>
                 <div class="scrollbar-container"></div>
            </div>

        <div class="row col-md-12">
            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="active breadcrumb-item" aria-current="page">Website Settings</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header">Mail Setting</div>
                </div>

            </div>
   
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