<!-- Modal For Add CourseToStudent -->
<div class="modal fade" id="modalForCourseToStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form id="AddStudentCourse" method="post">
     <div id="refreshFrm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Student Name</label>
            <input type="hidden" name="stuid"  value="<?php echo $_GET["id"]; ?>" autocomplete="off">
            <input type="hidden" name="stuname" value="<?php echo $selStudentRow["stu_fullname"]; ?>" autocomplete="off">
            <input disabled="" class="mb-2 form-control form-control" name="stuname" value="<?php echo $selStudentRow["stu_fullname"]; ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Student Email</label>
            <input disabled="" name="Stu_Course_Email" class="mb-2 form-control form-control"  value="<?php echo $selStudentRow['stu_email']; ?>" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Course</label>
            <select class="mb-2 form-control form-control" id="addstucoufrm" name="id_course">
              <option value="0">Select Course</option>
              <?php 
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                <?php }
               ?>
            </select>
          </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Close_modalForAddStu_Cou_frm" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>





<script>
//Update Student Profile
$(document).on("submit", "#updatestudentprofile", function(){
    $.post("libs/Student/updateprofile.php?token=student", $(this).serialize() , function(data){
      if(data.status == "exist")
      {
        NotificationError(data.stu_email + " Email Already Exist.","Already Exist!");
      }
      else if(data.status == "success")
      {
        toastr.success(data.stu_name + ' has been successfully Updated.','Success');
          refreshDiv();
      };
    }
    ,'json');
    return false;
});

//Clear Student Add Course Form
function ClearAddFrm(){
  document.getElementById("AddStudentCourse").reset();
};

//Add Student To Course frm
$(document).on("submit","#AddStudentCourse" , function(){
  $.post("libs/CourseStudent/addstudentcourse.php?id=1", $(this).serialize() , function(data){
    if(data.status == "exist")
  	{
      NotificationError(data.coursename + " Course Already Exist.","Already Exist!");
  	}
  	else if(data.status == "success")
  	{
      toastr.success(data.coursename + ' Course has been successfully Added.','Success');
      document.getElementById('Close_modalForAddStu_Cou_frm').click();         
      refreshDiv();
  	}else if (data.status == "empty"){
      NotificationError("Please Select Course First.","Select Course!");
    };
  },'json')
  return false;
});

//Delete Student To Course iNFO
$(document).on("click", "#deletestudentcourse", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this course?",
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
        url : "libs/CourseStudent/deletestudentcourse.php",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
            if(data.status == "success"){
              toastr.success(data.couname + ' Course has been successfully deleted.','Success');
              document.getElementById('modalForCourseToStudent').click();         
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