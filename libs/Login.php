<?php
session_start();
 /** @var object $conn */
 include("../conn.php");
 extract($_POST);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

       $selStudent = $conn->query("SELECT * FROM student_tbl WHERE Stu_Email='$Stu_Email' AND stu_password='$Stu_Pass'");

        if($selStudent->rowCount() > 0)
        {
            $StuInfo = $conn->query("SELECT * FROM student_tbl WHERE Stu_Email='$Stu_Email'")->fetch(PDO::FETCH_ASSOC);

            $_SESSION['StudetnSession'] = true;
            $_SESSION['Student_ID'] = $StuInfo['stu_id'];
            
            if ($RememberMe == "on"){
              if (isset($_COOKIE['MoSami_Email']) && isset($_COOKIE['MoSami_Pass'])) {
              }else{
                function encrypt($plaintext){
                  $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
                  $iv = openssl_random_pseudo_bytes($ivlen);
                  $key = "230932230943029";
                  $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
                  $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
                  $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
                  return $ciphertext;
                };
                setcookie("MoSami_Email", encrypt($Stu_Email), time()+60*60*24*365*20 , '/');
                setcookie("MoSami_Pass", encrypt($Stu_Pass), time()+60*60*24*365*20 , '/');
              };        
            }else{
              setcookie('MoSami_Email', '', time() - 3600, '/');
              setcookie('MoSami_Pass', '', time() - 3600, '/');
              
            };
            $res = array("status" => "success", "stu_email" => $Stu_Email);
        }
        else
        {
            $res = array("status" => "failed", "stu_email" => $Stu_Email);
        };

    echo json_encode($res);
  }else{
    header("location:../index.php");
  }
?>