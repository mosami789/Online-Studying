<title><?php  echo $WebTitle. ' | My Profile'; ?></title>

<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-user icon-gradient bg-dark"></i>
                        </div>
                        <div>Your Account Setting
                            <div class="page-title-subheading">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>     
            <div class="col-md-12">
                <div class="Exam_Card-withouthover">
                    <div class="Exam_Card-header">  
                        <div class="row" >
                            <div align="center" class="col-md-12">Student Profile</div>
                        </div>
                    </div>
                    <div class="Exam_Card-body">
                        <div class="row ml-1 col-md-12">
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <h4 class="alert alert-dark">Profile Photo</h4>
                                    <img class="rounded-circle mt-2" height="150px" width="150px" id="imagePreview" src="uploads/imgs/profiles/<?php echo $stu_fullname['stu_profile']; ?>">
                                    <span class="font-weight-bold mt-4"><?php echo $stu_fullname['stu_fullname']; ?></span>
                                    <span class="text-black-50"><?php echo $stu_fullname['stu_email']; ?></span>

                                    <form id="uploadprofilephoto" method="post" class="mt-4" enctype="multipart/form-data">
                                        <input style="display: none;" type="file" name="fileToUpload" id="imageInput">
                                        <label onclick="RefrshLisnter()" for="imageInput" class="btn btn-dark btn-rounded" style="cursor: pointer;">Upload Photo</label>
                                        <input style="display: none;" type="submit" id="sumbutphoto" name="submit">
                                    </form>
                                    
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div  class="p-3 py-5">
                                    <div class="d-flex flex-column align-items-center text-center mb-3">
                                        <h4 class="alert alert-dark">Profile Settings</h4>
                                    </div>
                                        <form id="updatestudentprofile" method="POST">
                                            <div class="row">
                                                <input type="hidden" name="stu_id" value="<?php echo $stu_fullname['stu_id']; ?>">
                                                <div class="col-md-6 mb-2"><legend class="labels">Fullname</legend><input name="fullname" type="text" class="form-control" placeholder="Input Fullname" value="<?php echo $stu_fullname['stu_fullname']; ?>"></div>
                                                <div class="col-md-6 mb-2"><legend class="labels">Email</legend><input name="email" type="email" class="form-control"  placeholder="Input Email"  value="<?php echo $stu_fullname['stu_email']; ?>"></div>
                                                <div class="col-md-6 mb-2"><legend class="labels">Password</legend><input name="pass" type="password" class="form-control" placeholder="Input Password" value="<?php echo $stu_fullname['stu_password']; ?>"></div>
                                                <div class="col-md-6 mb-2"><legend class="labels">Phone</legend><input name="phone" type="texr" class="form-control" placeholder="Input Phone Number" value="<?php echo $stu_fullname['stu_phone']; ?>"></div>
                                                <div class="form-group col-md-6 mb-2">
                                                <legend>Gender</legend>
                                                    <select class="form-control" name="gender">
                                                    <?php
                                                        $setGender = $stu_fullname['stu_gender'];
                                                        if ($setGender == 'Male' or $setGender == 'Male'){
                                                            echo '
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>';
                                                        }else{
                                                            echo '
                                                            <option value="Female">Female</option>
                                                            <option value="Male">Male</option>';
                                                        };
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 mb-2">
                                                    <legend>Birhdate</legend>
                                                    <input type="date" name="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off" value="<?php echo $stu_fullname['stu_birthdate']; ?>">
                                                </div>                
                                            </div>
                                            <div class="mt-3 text-center"><button type="submit" class="btn btn-dark btn-rounded" type="button">Save</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

<script>
//Update Student Profile
$(document).on("submit", "#updatestudentprofile", function(){
	$.post("libs/UpdateProfile.php", $(this).serialize() , function(data){
	  if(data.status == "exist")
		{
			Swal.fire({
				title: 'Already Exist',
				text: data.stu_email + " Email Already Exist.",
				icon: 'error',
				allowOutsideClick: false,
				confirmButtonColor: '#223C61',
				confirmButtonText: 'OK!'
			});
		}
		else if(data.status == "success")
		{
			Swal.fire({
			title: 'Success',
			text: "Your profile setting has been updated.",
			icon: 'success',
			allowOutsideClick: false,
			confirmButtonColor: '#223C61',
			confirmButtonText: 'OK!'
			}).then((result) => {
				if (result.value) {
					refreshDiv();
				};
			});
		};
   }
   ,'json');
	return false;
});

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
				confirmButtonColor: '#223C61',
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
					confirmButtonColor: '#223C61',
					confirmButtonText: 'OK!'
					});
			};
		},
	});
	return false;
});

var findinputimage = document.getElementById("imageInput");
function RefrshLisnter(){
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
</script>
