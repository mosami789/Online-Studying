<title><?php  echo $WebTitle. ' | Register Account'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="col-md-12" style="margin: auto; max-width: 850px; top: 10px">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 align="center" class="col-md-12 mt-3 mb-4">Register Student Account</h2>
                                <div class="divider"></div>
                                <form align="left" id="CreateStudentAccount" class="needs-validation col-md-12" novalidate method="POST">
                                    <div class="form-row" >
                                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom01">Student Name</label>
                                                <input style="border-radius: 10px;" name="Stu_name" type="text" class="form-control" id="validationCustom01" placeholder="Input Your Name" required> 
                                                <div class="invalid-feedback">
                                                    Please insert your name!
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom02" >Student Email</label>
                                                <input style="border-radius: 10px;" name="Stu_Email" type="email" class="form-control" id="validationCustom02" placeholder="Input Your Email" required>    
                                                <div class="invalid-feedback">
                                                    Please insert your email!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom03" >Student Password</label>
                                                <input style="border-radius: 10px;" name="Stu_Pass" type="password" class="form-control" id="validationCustom03" placeholder="Input Your Password" required>
                                                <div class="invalid-feedback">
                                                    Please insert your password!
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="validationCustom04" >Student Phone</label>
                                                <input style="border-radius: 10px;" name="Stu_Phone" type="tel" minlength="11" maxlength="11" class="form-control" id="validationCustom04" placeholder="Input Your Phone" required>
                                                <div class="invalid-feedback">
                                                    Please insert your phone!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                        <label for="validationCustom05">Gender</label>
                                            <select style="border-radius: 10px;" class="form-control"  name="Stu_Gender" id="validationCustom05" required>
                                                <option value="">Select gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                    Please select your gender!
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom06">Birthdate</label>
                                            <input type="date" name="Stu_Bdate" style="border-radius: 10px;" class="form-control" id="validationCustom06" placeholder="Input Birhdate" required>
                                            <div class="invalid-feedback">
                                                Please select your birthdate!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-center"><button style=" border-radius: 10px;" type="submit" class="btn btn-primary btn-lg col-md-4" type="button">Register Account</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
</div>
</div>

    
<script>
//Create Student Account
$(document).on("submit","#CreateStudentAccount" , function(){
  $.post("libs/Register.php", $(this).serialize() , function(data){
  	if(data.status == "exist")
  	{
	  Swal.fire(
		'Already Exist!',
		data.stu_email + " Already Exist.",
		'error'
	  )
  	}
  	else if(data.status == "success")
  	{
        Swal.fire({
        title: 'Success',
        text: data.stu_name + " Has Been Successfully Created.",
        icon: 'success',
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK!'
        }).then((result) => {
            if (result.value) {
                window.location.href='home.php?page=login';                
            };
        });
  	}
  },'json')
  return false;
});


(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>