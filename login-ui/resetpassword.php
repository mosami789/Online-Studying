<?php 
$token = $_GET["token"];
$ResetInfo = $conn->query("SELECT * FROM reset_password WHERE token_id ='$token'");
if ($ResetInfo->rowCount() > 0){
}else{
    header('Location: home.php');
};
$ResetInfo = $ResetInfo->fetch(PDO::FETCH_ASSOC);
$stuid = $ResetInfo['stu_id'];
$stu_fullname = $conn->query("SELECT * FROM student_tbl WHERE stu_id='$stuid' ")->fetch(PDO::FETCH_ASSOC);
?>
<title><?php  echo $WebTitle. ' | Reset Password'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="col-md-12" style="margin: auto; max-width: 480px; top: 10px">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 align="center" class="col-md-12 mt-3">Reset Student Password</h2>
                                <div class="divider"></div>
                                <form class="needs-validation" id="ResetPassword" method="POST" novalidate="">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="validationCustom01">Student Email</label>
                                            <input type="hidden" name="stuid" value="<?php echo $stu_fullname['stu_id']; ?>">
                                            <input type="hidden" name="order_id" value="<?php echo $ResetInfo['order_id']; ?>">
                                            <input disabled type="email" name="Stu_Email" class="form-control" id="validationCustom01" placeholder="Email" value="<?php echo $stu_fullname['stu_email'] ?>" required="">
                                            <div class="invalid-feedback">
                                                Please insert your email!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="validationCustom03">New Password</label>
                                            <input type="password" name="Stu_NewPass" class="form-control" id="validationCustom03" placeholder="Password" value="" required="">
                                            <div class="invalid-feedback">
                                                Please insert your password!
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="validationCustom04">Confirm New Password</label>
                                            <input type="password" name="Stu_NewPass2" class="form-control" id="validationCustom04" placeholder="Password" value="" required="">
                                            <div class="invalid-feedback">
                                                Please insert your password!
                                            </div>
                                        </div> 
                                    </div>
                                    <button class="btn btn-primary btn-lg col-md-12 mt-1" style="border-radius: 15px;" type="submit">Save New Password</button>
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
//Reset Password Login
$(document).on("submit","#ResetPassword" , function(){

   const password = document.getElementById("validationCustom03").value;
   const confirm_password = document.getElementById("validationCustom04").value;

    if (password == confirm_password){
        $.post("libs/SavePassword.php", $(this).serialize() , function(data){
            if(data.status == "failed"){
                Swal.fire(
                'Invalid',
                'There is an error , please try again.',
                'error'
                )
            }else if(data.status == "success"){
                Swal.fire({
                title: 'Success',
                text: "Your password successfully updated.",
                icon: 'success',
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK!'
                }).then((result) => {
                    if (result.value) {
                        window.location.href='home.php?page=login';                
                    };
                });
            };
        },'json');
    }else{
        Swal.fire(
            'Invalid',
            'Passwords do not match',
            'error'
        );
    };
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