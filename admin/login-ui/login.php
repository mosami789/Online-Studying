<?php 
function decrypt($ciphertext) {
    $ciphertext = base64_decode($ciphertext);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = substr($ciphertext, 0, $ivlen);
    $hmac = substr($ciphertext, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($ciphertext, $ivlen + $sha2len);
    $key = "230932230943029";
    $plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    if (!hash_equals($hmac, $calcmac)) {
      return false;
    }
    return $plaintext;
  }
?>
<title><?php  echo $WebTitle. ' | Admin Login'; ?></title>
<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="col-md-12" style="margin: auto; max-width: 480px; top: 10px">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div align="center" class="col-md-12 mt-3">
                                    <img class="rounded-circle mt-1" height="130px" width="130px" src="../assets/images/login2.png">
                                </div>
                                <h2 align="center" class="col-md-12 mt-3">Admin Login</h2>
                                <div class="divider"></div>
                                <form class="needs-validation" id="adminlogin" method="POST" novalidate="">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="validationCustom01">Username</label>
                                            <input type="" name="username" class="form-control" id="validationCustom01" placeholder="Email" value="<?php  echo decrypt( $_COOKIE['MoSami_AdminUsername']); ?>" required="">
                                            <div class="invalid-feedback">
                                                Please insert your email!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="validationCustom03">Password</label>
                                            <input type="password" name="pass" class="form-control" id="validationCustom03" placeholder="Password" value="<?php  echo decrypt( $_COOKIE['MoSami_AdminPass']); ?>" required="">
                                            <div class="invalid-feedback">
                                                Please insert your password!
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-row col-md-12 ml-2">
                                        <div class="col-md-6">
                                            <label class="form-check-label">
                                                <input type="checkbox" <?php if (isset($_COOKIE['MoSami_AdminUsername']) && isset($_COOKIE['MoSami_AdminPass'])) { echo 'checked'; }; ?> name="RememberMe" class="form-check-input">Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-lg col-md-12 mt-3" style="border-radius: 15px;" type="submit">Login</button>
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
// Admin Log in
$(document).on("submit","#adminlogin", function(){
   $.post("libs/adminlogin.php", $(this).serialize(), function(data){
      if(data.status == "failed")
      {
        Swal.fire(
          'Invalid',
          'Please input valid username / password',
          'error'
        )
      }
      else if(data.status == "success")
      {
        $('body').fadeOut();
        window.location.href='home.php';
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