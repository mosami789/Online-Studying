<!-- Modal For Add Lecture -->
<div class="modal fade" id="modalForAddLecture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 800px;">
   <form class="refreshFrm" id="addlecform" method="post" enctype="multipart/form-data">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddLectureTitle">Add Lecture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row ">
        <div class="col-md-6 ml-2">
          <div class="form-group">
            <label>Lecture Name</label>
            <input type="" name="lec_name" class="mb-2 form-control form-control" placeholder="Input Lecture Name" required="" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Course</label>
            <?php
            $id = $_GET["id"];
            $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
            ?>
            <input type="hidden" name="cou_id" class="mb-2 form-control form-control" value="<?php echo $selCourse['cou_id']; ?>" required="" autocomplete="off">
            <input disabled="" name="cou_name" class="mb-2 form-control form-control" value="<?php echo $selCourse['cou_name']; ?>" required="" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Video Link</label>
            <input name="video_link" id="AddLecVideo" class="form-control form-control" required="" placeholder="Input Lecture Video Link" >
          </div>
          <div class="form-group">
            <label>Lecture Time (Days)</label>
            <input type="number" name="Lec_Time" class="form-control form-control" required="" placeholder="Input Lecture Time (Days)" >
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="lec_description" class="form-control form-control " required="" placeholder="Input Lecture Description" style="height: 132px;"></textarea>
          </div>
        </div>
        <div align="center" class="col-md-5" style="margin: auto;">
        <div align="center" class="alert alert-danger col-md-12">Note : Photo should be 280x280 pixel</div>
          <div class="form-group">
              <h4 class="alert alert-dark">Lecture Photo</h4>
              <img class="mt-2" height="280px" width="280px" id="imagePreview" src="../uploads/imgs/lectures/index.png">
              <input style="display: none;" type="file" name="fileToUpload" id="imageInput">
              <input type="hidden" id="CheckUploadPhoto" name="CheckPhoto" value="NoPhoto">
              <label for="imageInput" class="btn btn-dark mt-3" style="cursor: pointer;">Upload Photo</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForAddLecture" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<!-- Modal For Update Lecture -->
<div class="modal fade" id="modalForUpdateLecture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 800px;">
   <form class="refreshFrm" id="updateLectureFrm" method="post" enctype="multipart/form-data">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UpdateLectureTitle">Update Lecture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6 ml-2">
          <div class="form-group">
            <label>Lecture Name</label>
            <input type="hidden" name="lec_id" id="LectureUpdateID" class="form-control" value="">
            <input type="" name="newLecname" id="LectureUpdateTitle" class="mb-2 form-control form-control" placeholder="Input Lecture Name" required="" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Course</label>
            <?php
            $id = $_GET["id"];
            $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);
            ?>
            <input type="hidden" name="cou_id" id="cou_id" class="mb-2 form-control form-control" value="<?php echo $selCourse['cou_id']; ?>" required="" autocomplete="off">
            <input disabled="" name="cou_name" id="cou_name" class="mb-2 form-control form-control" value="<?php echo $selCourse['cou_name']; ?>" required="" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Video Link</label>
            <input type="" name="video_link" id="LectureUpdateVideoLink" class="form-control form-control" required="" placeholder="Input Lecture Video Link" >
          </div>
          <div class="form-group">
            <label>Lecture Time (Days)</label>
            <input name="Lec_Time" id="LectureUpdateTime" class="form-control form-control" required="" placeholder="Input Lecture Time (Days)" >
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="lec_description" id="LectureUpdateDescription" class="form-control form-control " required="" placeholder="Input Lecture Description" style="height: 132px;"></textarea>
          </div>
        </div>
        <div align="center" class="col-md-5" style="margin: auto;">
        <div align="center" class="alert alert-danger col-md-12">Note : Photo should be 280x280 pixel</div>
          <div class="form-group">
          <h4 class="alert alert-dark">Lecture Photo</h4>
          <img class="mt-2" height="280px" width="280px" id="imagePreview2" src="">
              <input style="display: none;" type="file" name="fileToUpload" id="imageInput2">
              <input type="hidden" id="CheckUploadPhoto2" name="CheckPhoto" value="NoPhoto">
              <label for="imageInput2" class="btn btn-dark mt-3" style="cursor: pointer;">Upload Photo</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="Close_modalForUpdateLec" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
   </form>
  </div>
</div>

<script>
//Clear add lecture frm
$(document).on("click","#btnaddlec" , function(){
  document.getElementById("addlecform").reset();
  document.getElementById("CheckUploadPhoto").value = 'NoPhoto';
  document.getElementById("imagePreview").src = "../uploads/imgs/lectures/index.png";

});

//Add Lecture
$(document).on("submit","#addlecform" , function(event){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/Lectures/addlecture.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success")
			{
        Notification(data.lec_name + " Lecture has been Successfully Added.","Success");
        document.getElementById('Close_modalForAddLecture').click();
        refreshDiv();   
			}else{
        NotificationError(data.msg);
			};
		},
	});
  return false;
});

//Upload Lecture Photo
var findinputimage = document.getElementById("imageInput");     
  if (findinputimage){
	  document.getElementById('imageInput').addEventListener('change', function(event) {
		var file = event.target.files[0]; 
		var image = document.getElementById('imagePreview');
	  
		var reader = new FileReader();
		reader.onload = function(e) {
		  image.src = e.target.result; 
		};
		reader.readAsDataURL(file);
    document.getElementById("CheckUploadPhoto").value="PhotoFound"
	});
};

//Get Lecture iNFO For Update frm
$(document).on("click","#GetInfoForLecturefrm" , function(e){
  e.preventDefault();
  var id = $(this).data("id");
  document.getElementById("updateLectureFrm").reset();
  $.ajax({
    type : "post",
    url : "libs/Lectures/GetLectureInfo.php",
    dataType : "json",  
    data : {id:id},
    cache : false,
    success : function(data){
      if(data.status == "success")
      {
        document.getElementById("UpdateLectureTitle").innerText = "Update Lecture (" + data.Lec_Title + ")";
        document.getElementById("LectureUpdateID").value = data.Lec_Id;
        document.getElementById("LectureUpdateTitle").value = data.Lec_Title;
        document.getElementById("LectureUpdateTime").value = data.Lec_Time;
        document.getElementById("LectureUpdateVideoLink").value = data.Lec_VideoLink;
        document.getElementById("LectureUpdateDescription").value = data.Lec_Description;
        document.getElementById("CheckUploadPhoto2").value = 'NoPhoto';
        document.getElementById("imagePreview2").src = "../uploads/imgs/lectures/" + data.Lec_img;
      };
    },
    error : function(xhr, ErrorStatus, error){
      console.log(status.error);
    }
  });
 
});

//Upload For Update Lecture Photo
var findinputimage = document.getElementById("imageInput2");     
  if (findinputimage){
	  document.getElementById('imageInput2').addEventListener('change', function(event) {
		var file = event.target.files[0]; 
		var image = document.getElementById('imagePreview2');
	  
		var reader = new FileReader();
		reader.onload = function(e) {
		  image.src = e.target.result; 
		};
		reader.readAsDataURL(file);
    document.getElementById("CheckUploadPhoto2").value="PhotoFound"
	});
};

//Update Lecture
$(document).on("submit","#updateLectureFrm" , function(event){
  event.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url: 'libs/Lectures/updatelecture.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success")
			{
				Notification(data.newLecname + " Lecture has been successfully updated.","Success");
        document.getElementById('Close_modalForUpdateLec').click();         
        refreshDiv();
			}else{
        NotificationError(data.newLecname + " Lecture Already Exist.","Already Exist!");
			};
		},
	});
  
  return false;
});

//Delete Lecture
$(document).on("click", "#deletelecture", function(e){
  e.preventDefault();
  var id = $(this).data("id");
  Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this Lecture?",
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
        url : "libs/Lectures/deletelecture.php",
        dataType : "json",  
        data : {id:id},
        cache : false,
        success : function(data){
            if(data.status == "success"){
              toastr.success(data.Lec_name + ' Lecture has been successfully deleted.','Success');
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

