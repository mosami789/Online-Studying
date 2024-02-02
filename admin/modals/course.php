<!-- Modal For Update Course -->
<div class="modal fade" id="modalForUpdateCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 650px;">
   <form class="refreshFrm" id="updateCourseFrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UpdateCourseTitle">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Course Name</label>
            <input type="hidden" name="course_id" id ="CourseUpdateId">
            <input name="newCourseName" id="CourseUpdateTitle" class="mb-2 form-control form-control" placeholder="Input Course Name" required="" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Description</label>
            <textarea name="cou_description" id="CourseUpdateDescription" class="form-control form-control " placeholder="Input Course Description" required="" autocomplete="off" style="height: 235px;"></textarea>
          </div>
        </div>
        <div align="center" class="col-md-6" style="margin: auto;">
          <div align="center" class="alert alert-danger col-md-12">Note : Photo should be 270x210 pixel</div>
          <div class="form-group">
              <img class="mt-2" height="210px" width="270px" id="imagePreviewUpdateCourse" src="">
              <input style="display: none;" type="file" name="fileToUpload" id="imageInputUpdateCourse">
              <input type="hidden" id="CheckUploadPhotoUpdateCourse" name="CheckPhoto" value="NoPhoto">
              <label for="imageInputUpdateCourse" class="btn btn-dark mt-3" style="cursor: pointer;">Upload Photo</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForUpdateCourse" type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button type="submit" class="btn btn-primary">Update Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<script>
//Get Course iNFO For Update frm
$(document).on("click","#GetCourseForUpdatefrm" , function(e){
  e.preventDefault();
  var id = $(this).data("id");
  document.getElementById("updateCourseFrm").reset();
  $.ajax({
    type : "post",
    url : "libs/Course/GetCourseInfo.php",
    dataType : "json",  
    data : {id:id},
    cache : false,
    success : function(data){
      if(data.status == "success"){
          document.getElementById("UpdateCourseTitle").innerText = "Update Course (" + data.Cou_name + ")";
          document.getElementById("CourseUpdateId").value = id;
          document.getElementById("CourseUpdateTitle").value = data.Cou_name;
          document.getElementById("CourseUpdateDescription").value = data.Cou_description;
          document.getElementById("CheckUploadPhotoUpdateCourse").value = 'NoPhoto';
          document.getElementById("imagePreviewUpdateCourse").src = "../uploads/imgs/courses/" + data.img;
      };
    },
    error : function(xhr, ErrorStatus, error){
      console.log(status.error);
    }
  });
});

//Update Course Photo
var findinputimageCourse = document.getElementById("imageInputUpdateCourse");     
  if (findinputimageCourse){
	  document.getElementById('imageInputUpdateCourse').addEventListener('change', function(event) {
		var file = event.target.files[0]; 
		var image = document.getElementById('imagePreviewUpdateCourse');
	  
		var reader = new FileReader();
		reader.onload = function(e) {
		  image.src = e.target.result; 
		};
		reader.readAsDataURL(file);
    document.getElementById("CheckUploadPhotoUpdateCourse").value="PhotoFound"
	});
};

// Update Course
$(document).on("submit","#updateCourseFrm" , function(event){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/Course/updatecourse.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
    if(data.status == "exist"){
      NotificationError(data.newCourseName + "  Already Exist.","Already Exist!");
  	}else if(data.status == "success"){
      Notification(data.newCourseName + " Course has been successfully updated.","Success");
      document.getElementById('Close_modalForUpdateCourse').click();         
      refreshDiv();
    };
		},
	});
  return false;
});

//Delete Course
$(document).on("click", "#deletecourse", function(e){
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
        url : "libs/Course/deletecourse.php",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            toastr.success(data.Cou_name + ' Course has been successfully deleted.','Success');
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