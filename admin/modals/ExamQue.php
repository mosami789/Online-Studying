<!-- Modal For Add Question Header -->
<div class="modal fade" id="modalForAddHeaderQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="AddQuestionHeader" method="post" enctype="multipart/form-data">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Header Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Title</label>
            <input type="hidden" name="exam_id" value="<?php echo $_GET["id"]; ?>">
            <input name="title" id="AddHeader_title" class="mb-2 form-control form-control" placeholder="Input Title" required="" autocomplete="off">
          </div>          
          <div class="form-group">
            <label>Text</label>
            <textarea name="text" id="AddHeader_text" class="form-control form-control " placeholder="Input Text" autocomplete="off" style="height: 200px;"></textarea>
          </div>
          <div align="center" class="col-md-12" >
          <div class="form-group row">
              <input style="display: none;" type="file" name="fileToUpload" id="imageInput">
              <label for="imageInput" class="btn btn-dark mt-1" style="cursor: pointer; ">Upload Photo</label>
              <input type="hidden" id="CheckUploadPhoto" name="CheckPhoto" value="NoPhoto">
              <h6 style="margin: auto;" id="fileNameLabel" class="ml-3">No Photo Chosen...</h6>
          </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForAddQueHeader" type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<!-- Modal For Update Question Header -->
<div class="modal fade" id="modalForUpdateHeaderQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="UpdateQuestionHeader" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Header Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Title</label>
            <input type="hidden" id="Que_headerId" name="id">
            <input name="title" id="UpdateTitleHeader" class="mb-2 form-control form-control" placeholder="Input Title" required="" autocomplete="off">
            <input type="hidden" id="CheckUploadPhoto" name="CheckPhoto" value="NoPhoto">
          </div>          
          <div class="form-group">
            <label>Text</label>
            <textarea name="text" id="UpdateTextHeader" class="form-control form-control " placeholder="Input Text" autocomplete="off" style="height: 132px;"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForUpdateQueHeader" type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
   </form>
  </div>
</div>

<!-- Modal For Add Question For Exam -->
<div class="modal fade" id="modalForAddQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Question - <?php echo $selExamRow['ex_title']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="refreshFrm" method="post" id="addQuestionFrm">
          <div class="modal-body">
            <div class="col-md-14">
              <div class="form-group">
                <legend>Question</legend>
                <input type="hidden" name="examId" value="<?php echo $exId; ?>">
                <input type="hidden" id="QueHeader_ID" name="QueHeaderID">
                <textarea name="question" id="AddQuestion2" Class="form-control " placeholder="Input question" required="" autocomplete="off" style="height: 132px;"></textarea>
              </div>
              <fieldset>
                <legend>Input word for choice's</legend>
                  <div class="form-row">
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label>Choice A</label>
                                <input type="" name="choice_A" id="choiceA"  placeholder="Input choice A" class="form-control" autocomplete="off">
                            </div>
                      </div>
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label>Choice B</label>
                            <input type="" name="choice_B" id="choiceB" placeholder="Input choice B" class="form-control" autocomplete="off">
                        </div>
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                           <label>Choice C</label>
                          <input type="" name="choice_C" id="choiceC" placeholder="Input choice C" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="position-relative form-group">
                          <label>Choice D</label>
                          <input type="" name="choice_D" id="choiceD" placeholder="Input choice D" class="form-control" autocomplete="off">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Correct Answer</label>
                      <input type="" name="correctAnswer" id="choiceAnwser" required class="form-control" placeholder="Input correct answer" autocomplete="off">
                    </div>
                </fieldset>
            </div>
          </div>
          <div class="modal-footer">
          <button id="Close_modalForAddQue" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Now</button>
          </div>
        </form>        
        </div>
        </div>      
</div>

<!-- Modal For Update Question For Exam -->
<div class="modal fade" id="modalForUpdateQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Question - <?php echo $selExamRow['ex_title']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="refreshFrm" method="post" id="UpdateQuestionFrm">
          <div class="modal-body">
            <div class="col-md-14">
              <div class="form-group">
                <legend>Question</legend>
                <input type="hidden" id="Que_ID" name="Que_ID">
                <textarea name="question" id="UpdateQuestion2" Class="form-control " placeholder="Input question" required="" autocomplete="off" style="height: 132px;"></textarea>
              </div>
              <fieldset>
                <legend>Input word for choice's</legend>
                  <div class="form-row">
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label>Choice A</label>
                                <input name="choice_A" id="ChoiceA" placeholder="Input choice A" class="form-control" autocomplete="off">
                            </div>
                      </div>
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label>Choice B</label>
                            <input name="choice_B" id="ChoiceB" placeholder="Input choice B" class="form-control" autocomplete="off">
                        </div>
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                           <label>Choice C</label>
                          <input name="choice_C" id="ChoiceC" placeholder="Input choice C" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="position-relative form-group">
                          <label>Choice D</label>
                          <input name="choice_D" id="ChoiceD" placeholder="Input choice D" class="form-control" autocomplete="off">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Correct Answer</label>
                      <input name="correctAnswer" id="ChoiceAnswer" required class="form-control" placeholder="Input correct answer" autocomplete="off">
                    </div>
                </fieldset>
            </div>
          </div>
          <div class="modal-footer">
          <button id="Close_modalForUpdateQue" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>        
        </div>
        </div>      
</div>
    

<script>
//Clear Add Header Form
function CleanCreateHeaderFrm(){
    document.getElementById("AddQuestionHeader").reset();
    document.getElementById("CheckUploadPhoto").value="NoPhoto";
    document.getElementById("fileNameLabel").innerHTML = "No Photo Chosen...";
};

//Add Question Header
$(document).on("submit","#AddQuestionHeader" , function(event){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/ExamQuestion/AddQuestionHeader.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success")
			{
        Notification("Question header has been successfully added.","Success");
        document.getElementById('Close_modalForAddQueHeader').click();
        location.reload();
			}else if (data.status == "exist"){
        NotificationError("This question header is already exist", "Error");
			}else{
        NotificationError(data.msg, "Error");
      };
		},
	});
  return false;
});

var uploadBtn = document.getElementById("imageInput");
var fileNameLabel = document.getElementById("fileNameLabel");
uploadBtn.addEventListener("change", function() {
  var selectedFile = uploadBtn.files[0];
  document.getElementById("CheckUploadPhoto").value="PhotoFound"
  fileNameLabel.textContent = selectedFile.name;
});

//Get Header Info For Update
function GetHeaderInfo(id){
  $.ajax({
    type : "post",
    url : "libs/ExamQuestion/GetHeaderQueInfo.php",
    dataType : "json",  
    data : {id:id},
    cache : false,
    success : function(data){
      if(data.status == "success")
      {
        document.getElementById("Que_headerId").value = id;
        document.getElementById("UpdateTitleHeader").value = data.title;
        document.getElementById("UpdateTextHeader").value = data.Que_Text;
       };
    },
    error : function(xhr, ErrorStatus, error){
      console.log(status.error);
    }
  });
};

//Update Question Header
$(document).on("submit","#UpdateQuestionHeader" , function(event){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/ExamQuestion/UpdateQuestionHeader.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success")
			{
        Notification("Question header has been successfully updated.","Success");
        document.getElementById('Close_modalForUpdateQueHeader').click();
        refreshDiv();   
			}else if (data.status == "exist"){
        NotificationError("This question header is already exist", "Error");
			}else{
        NotificationError(data.msg, "Error");
      };
		},
	});
  return false;
});

//Update Photo

function TestFunction(id){
var fileInputs = document.querySelectorAll('input[type="file"][data-id]');
fileInputs.forEach(function(input) {
  input.addEventListener('change', function(event) {
    var id = input.getAttribute('data-id');


    var file = event.target.files[0]; 
    var image = document.getElementById('imagePreview_' + id);
    
    var reader = new FileReader();
    reader.onload = function(e) {
        image.src = e.target.result; 
    };
    reader.readAsDataURL(file);
    document.getElementById("imagePreview_" + id).style.display = "block";
    document.getElementById("Sumbit_UpdatePhotoHeader_" + id).click();
  });
});
};

//Update Question Header Photo
$(document).on("submit","#UpdatePhotoHeader" , function(event){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/ExamQuestion/UpdateQuestionHeader.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success"){
            Notification("Question header Photo has been successfully updated.","Success");
            refreshDiv();
        }else{
            NotificationError(data.msg, "Error");
        };
		},
	});
  return false;
});

//Delete Question Header Photo Photo
$(document).on("click", "#DeletePhotoHeader", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this photo from header?",
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
        url : "libs/ExamQuestion/DeleteQuestionHeader.php?id=1",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            toastr.success('Photo has been successfully deleted.','Success');
            document.getElementById("imagePreview_"+ id).style.display = "none";
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

//Delete Question Header
$(document).on("click", "#DeleteQuestionHeader", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this question header?",
			icon: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete  now!'
		}).then((result) => {
      if (result.value) {
        $.ajax({
        url: 'libs/ExamQuestion/DeleteQuestionHeader.php',
        dataType : "json",  
        type: 'POST',
        data : {id:id},
        cache : false,
        success : function(data){
        if(data.status == "success")
          {
            toastr.success('Question header has been successfully deleted.','Success');
            refreshDiv();   
          }else{
            NotificationError("There's an error , please try again.", "Error");
          };
        },
      });
      };
    });
  return false;
});

//Form Add Question
function CreateQue(que_Id){
  document.getElementById("addQuestionFrm").reset()
  document.getElementById("QueHeader_ID").value = que_Id;
};

//Add Question Exam
$(document).on("submit","#addQuestionFrm" , function(){
  $.post("libs/ExamQuestion/addquestionExam.php", $(this).serialize() , function(data){
    if(data.status == "exist")
  	{
      NotificationError("This question is already exist", "Error");
      }
      else if(data.status == "success")
      {
        Notification("Question has been successfully added.","Success");
        document.getElementById('Close_modalForAddQue').click();
        refreshDiv();   
      }else{
        NotificationError("There's an error , please try again.", "Error");
      };
    },'json')
    return false;
});

//Get Question Info
function GetQuestionInfo(id){
  $.ajax({
    type : "post",
    url : "libs/ExamQuestion/GetQuestionInfo.php",
    dataType : "json",  
    data : {id:id},
    cache : false,
    success : function(data){
      if(data.status == "success")
      {
        document.getElementById("Que_ID").value = id;
        document.getElementById("UpdateQuestion2").value = data.question;
        document.getElementById("ChoiceA").value = data.exam_ch1;
        document.getElementById("ChoiceB").value = data.exam_ch2;
        document.getElementById("ChoiceC").value = data.exam_ch3;
        document.getElementById("ChoiceD").value = data.exam_ch4;
        document.getElementById("ChoiceAnswer").value = data.exam_answer;
       };
    },
    error : function(xhr, ErrorStatus, error){
      console.log(status.error);
    }
  });
};

//Update Question Exam
$(document).on("submit","#UpdateQuestionFrm" , function(){
  $.post("libs/ExamQuestion/UpdateQuestion.php", $(this).serialize() , function(data){
    if(data.status == "exist")
  	{
      NotificationError("This question is already exist", "Error");
      }
      else if(data.status == "success")
      {
        Notification("Question has been successfully updated.","Success");
        document.getElementById('Close_modalForUpdateQue').click();
        refreshDiv();   
      }else{
        NotificationError("There's an error , please try again.", "Error");
      };
    },'json')
    return false;
});

//Delete Question Exam
$(document).on("click", "#deleteQuestion", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this question from header?",
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
        url : "libs/ExamQuestion/deletequestionExam.php",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
          if(data.status == "success"){
            toastr.success('Question has been successfully deleted.','Success');
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
