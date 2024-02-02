<?php 
   $AdminId = $_GET['id'];
   $selStudent = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$AdminId' ");
   $selStudentRow = $selStudent->fetch(PDO::FETCH_ASSOC);
 ?>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-id icon-gradient bg-plum-plate">
                            </i>
                        </div>
                        <div>Admin Profile  -  <?php echo $selStudentRow['admin_name']; ?></div>
                    </div> 
                </div>
            </div>
            <div class="scrollbar-container"></div>   
    
            <div class="col-md-12">
                <div class="container rounded bg-white mb-5 p-4">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <div  class="p-3 py-5">
                                <div class="d-flex flex-column align-items-center align-items-center mb-3">
                                    <h4 class="text-center">Profile Settings</h4>
                                </div>
                                <form id="updateadminprofile" method="POST">
                                    <div class="row mt-2">
                                        <input type="hidden" name="admin_id" value="<?php echo $AdminId; ?>">
                                        <div class="col-md-12 mb-2"><label class="labels">Fullname</label><input name="fullname" type="text" class="form-control" placeholder="Input Fullname" value="<?php echo $selStudentRow['admin_name']; ?>"></div>
                                        <div class="col-md-12 mb-2"><label class="labels">Username</label><input name="user" type="text" class="form-control"  placeholder="Input Email"  value="<?php echo $selStudentRow['admin_user']; ?>"></div>
                                        <div class="col-md-12 mb-2"><label class="labels">Password</label><input name="pass" type="password" class="form-control" placeholder="Input Password" value="<?php echo $selStudentRow['admin_pass']; ?>"></div>
                                    </div>                
                                    <div class="mt-3 text-center"><button type="submit" class="btn btn-primary profile-button" type="button">Save</button></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <h4 class="p-2">Profile Photo</h4>
                                    <img class="rounded-circle mt-4" height="150px" width="150px" id="imagePreview" src="./profile/images/<?php echo $selStudentRow['admin_img']; ?>">
                                    <span class="font-weight-bold mt-4"><?php echo $selStudentRow['admin_name']; ?></span>
                                    <form id="uploadprofilephoto" method="post" class="mt-3" enctype="multipart/form-data">
                                        <input style="display: none;" type="file" name="fileToUpload" id="imageInput">
                                        <label for="imageInput" class="btn btn-primary btn-rounded" style="cursor: pointer;">Upload Photo</label>
                                        <input style="display: none;" type="submit" id="sumbutphoto" name="submit">
                                    </form>
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
//Update Admin Profile
$(document).on("submit", "#updateadminprofile", function(){
  $.post("libs/Student/updateprofile.php?token=admin", $(this).serialize() , function(data){
  	if(data.status == "success")
  	{
      toastr.success('Profile has been successfully Updated.','Success');
      refreshDiv();
  	};
 }
 ,'json');
  return false;
});

//Update Photo
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

        document.getElementById("sumbutphoto").click();
	});
};

//Update Profile Photo
$(document).on("submit", "#uploadprofilephoto", function(event){
	event.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: 'libs/UploadPhoto.php',
		dataType : "json",  
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success : function(data){
		if(data.status == "success")
			{
				Swal.fire({
				title: 'Success',
				text: "Your profile photo has been updated.",
				icon: 'success',
				allowOutsideClick: false,
				confirmButtonColor: '#0069d9',
				confirmButtonText: 'OK!'
				}).then((result) => {
					if (result.value) {
						location.reload();
					};
				});
			}else{
				Swal.fire({
					title: 'Error',
					text: data.msg,
					icon: 'error',
					allowOutsideClick: false,
					confirmButtonColor: '#0069d9',
					confirmButtonText: 'OK!'
					});
			};
		},
	});
	return false;
});
</script>