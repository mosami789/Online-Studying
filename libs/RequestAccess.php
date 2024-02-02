<?php
    if ($status == 'access'){
        function generateToken() {
            return bin2hex(random_bytes(32));
        };
        $token = generateToken();
        $_SESSION['token'] = $token;
    }else{
        header("location:../home.php");
    }
?>