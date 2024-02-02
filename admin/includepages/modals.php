<!-- Modal For Add Course -->
<div class="modal fade" id="modalForAddCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 650px;">
   <form class="refreshFrm" id="addcoursefrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Course Name</label>
            <input name="cou_name" class="mb-2 form-control form-control" placeholder="Input Course Name" required="" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Description</label>
            <textarea name="cou_description" class="form-control form-control" placeholder="Input Course Description" required="" autocomplete="off" style="height: 235px;"></textarea>
          </div>
        </div>
        <div align="center" class="col-md-6" style="margin: auto;">
          <div align="center" class="alert alert-danger col-md-12">Note : Photo should be 270x210 pixel</div>
          <div class="form-group">
              <img class="mt-2" height="210px" width="270px" id="imagePreviewCourse" src="../uploads/imgs/lectures/index.png">
              <input style="display: none;" type="file" name="fileToUpload" id="imageInputCourse">
              <input type="hidden" id="CheckUploadPhotoCourse" name="CheckPhoto" value="NoPhoto">
              <label for="imageInputCourse" class="btn btn-dark mt-3" style="cursor: pointer;">Upload Photo</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForAddCourse" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<!-- Modal For Add Exam -->
<div class="modal fade" id="modalForExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addexamfrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Exam Name</label>
            <input name="examTitle" class="mb-2 form-control form-control" placeholder="Input Exam Name" required="" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Course</label>
            <select class="mb-2 form-control form-control" required="" name="id_course">
              <option value="0">Select Course</option>
              <?php 
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                <?php }
               ?>
            </select>
          </div>
          <div class="form-group">
            <label>Show Results</label>
            <select class="mb-2 form-control form-control" required="" name="ResultsStatus">
              <option value="yes">Enable</option>
              <option value="no">Disable</option>
            </select>
          </div>
          <div class="form-group">
            <label>DeadLine</label>
            <input type="date" name="deadlinedate" class="form-control" required="" placeholder="Input Birhdate" autocomplete="off" >
          </div>
          <div class="form-group">
            <label>Exam Time Limit (Minutes)</label>
            <input name="timeLimit" type="number" class="mb-2 form-control form-control" placeholder="Input Exam Time Limit" required="" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="examDesc" class="form-control form-control " placeholder="Input Exam Description" required="" autocomplete="off" style="height: 80px;"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Close_modalForAddExam" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<!-- Modal For Add Student -->
<div class="modal fade" id="modalForAddExaminee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addStudentFrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Fullname</label>
            <input type="hidden" name="status" value="Active">
            <input type="text" name="fullname" class="form-control" placeholder="Input Fullname" autocomplete="off" required="">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Input Email" autocomplete="off" required="">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Input Password" autocomplete="off" required="">
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Input Phone" autocomplete="off" required="">
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender">
              <option value="0">Select gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label>Birhdate</label>
            <input type="date" name="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off" >
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForAddStudent" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<!-- Modal For Add Assignment -->
<div class="modal fade" id="modalForAddeAssignments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addassifrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Assignment Name</label>
            <input name="assi_name" class="mb-2 form-control form-control" placeholder="Input Assignment Name" required="" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Course</label>
            <select class="mb-2 form-control form-control"  name="id_course">
              <option value="0">Select Course</option>
              <?php 
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                <?php }
               ?>
            </select>
          </div>
          <div class="form-group">
            <label>DeadLine</label>
            <input type="date" name="deadlinedate" class="form-control" required="" placeholder="Input Birhdate" autocomplete="off" >
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="assi_description" class="form-control form-control-lg " placeholder="Input Exam Description" required="" required="" autocomplete="off" style="height: 132px;"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForAddAssi" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>




<script>
//Add Course
$(document).on("submit","#addcoursefrm" , function(event){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/Course/addcourse.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
    if(data.status == "exist"){
      NotificationError(data.cou_name + " Course Already Exist.","Already Exist!");
  	}else if(data.status == "success"){
      Notification(data.cou_name + " Course has been Successfully Added.","Success");
      document.getElementById('Close_modalForAddCourse').click();
      refreshDiv();   
    };
		},
	});
  return false;
});

//Upload Course Photo
var findinputimageCourse = document.getElementById("imageInputCourse");     
  if (findinputimageCourse){
	  document.getElementById('imageInputCourse').addEventListener('change', function(event) {
		var file = event.target.files[0]; 
		var image = document.getElementById('imagePreviewCourse');
	  
		var reader = new FileReader();
		reader.onload = function(e) {
		  image.src = e.target.result; 
		};
		reader.readAsDataURL(file);
    document.getElementById("CheckUploadPhotoCourse").value="PhotoFound"
	});
};

//Add Exam
$(document).on("submit","#addexamfrm" , function(){
  $.post("libs/Exam/addexam.php", $(this).serialize() , function(data){
  	if(data.status == "exist")
  	{
      NotificationError(data.examTitle + " Exam Already Exist.","Already Exist!");      
  	}
  	else if(data.status == "success")
  	{
      Notification(data.examTitle + " Exam has been Successfully Added.","Success");
      document.getElementById('Close_modalForAddExam').click();
      refreshDiv();   
  	}
    else if(data.status == "empty")
    {
      NotificationError(data.msg,data.title);
    }
  },'json')
  return false;
});

//Add Assignment
$(document).on("submit","#addassifrm" , function(){
  $.post("libs/Assignments/addassi.php", $(this).serialize() , function(data){
  	if(data.status == "exist")
  	{
      NotificationError(data.assi_name + " Assignment Already Exist.","Already Exist!");      
  	}
  	else if(data.status == "success")
  	{
      Notification(data.assi_name + " Assignment has been Successfully Added.","Success");
      document.getElementById('Close_modalForAddAssi').click();
      refreshDiv();   
  	}
    else if(data.status == "empty")
    {
      NotificationError(data.msg,data.title);
    }
  },'json')
  return false;
});

//Add Student
$(document).on("submit","#addStudentFrm" , function(){
  $.post("libs/Student/addstudent.php", $(this).serialize() , function(data){
    if(data.status == "exist")
  	{
      NotificationError(data.stu_email + " Email Already Exist.","Already Exist!");
  	}
  	else if(data.status == "success")
  	{
      toastr.success(data.stu_name + ' has been successfully Added.','Success');
      document.getElementById('Close_modalForAddStudent').click();         
      refreshDiv();
  	}
  },'json')
  return false;
});

/////////// Clear SideBar Forms ///////////
//Clear Frm Add Course 
$(document).on("click","#btnaddcourse" , function(){
  document.getElementById("addcoursefrm").reset();
  document.getElementById("CheckUploadPhotoCourse").value = 'NoPhoto';
  document.getElementById("imagePreviewCourse").src = '../uploads/imgs/courses/index.png';
});

//Clear add Exam frm
$(document).on("click","#btnaddExam" , function(){
  document.getElementById("addexamfrm").reset();
});

//Clear Frm Add Assignment
$(document).on("click","#btnaddassi" , function(){
  document.getElementById("addassifrm").reset();
});

//Clear Frm Add Student
$(document).on("click","#btnaddstudent" , function(){
  document.getElementById("addStudentFrm").reset();
});
</script>