<title><?php  echo $WebTitle. ' | Forgot Password'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="col-md-12" style="margin: auto; max-width: 480px; top: 10px">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 align="center" class="col-md-12 mt-3">Forgot Password</h2>
                                <div class="divider"></div>
                                <form class="needs-validation" id="ResetPassword" method="POST" novalidate="">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="validationCustom01">Student Email</label>
                                            <input type="email" name="Stu_Email" class="form-control" id="validationCustom01" placeholder="Put your email" value="" required="">
                                            <div class="invalid-feedback">
                                                Please insert your email!
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-lg col-md-12 mt-1" style="border-radius: 15px;" type="submit">Reset Password</button>
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
//Send Request
$(document).on("submit","#ResetPassword" , function(){
	$.post("libs/ResetPassword.php", $(this).serialize() , function(data){
		if(data.status == "failed")
      {
        Swal.fire(
          '',
          data.msg,
          'error'
        )
      }
      else if(data.status == "success")
      {
        Swal.fire({
				title: 'Success',
				text: "Please check your email to reset your password.",
				icon: 'success',
				allowOutsideClick: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'OK!'
				}).then((result) => {
					if (result.value) {
						location.reload();
                        
					};
				});
      }
   	},'json');
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