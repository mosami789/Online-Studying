<?php 
 /** @var object $conn */
session_start();
 include("../../conn.php");
 

extract($_POST);

$selAcc = $conn->query("SELECT * FROM admin_acc WHERE admin_user='$username' AND admin_pass='$pass'  ");
$selAccRow = $selAcc->fetch(PDO::FETCH_ASSOC);


if($selAcc->rowCount() > 0)
{

    if ($RememberMe == "on"){
      if (isset($_COOKIE['MoSami_AdminUsername']) && isset($_COOKIE['MoSami_AdminPass'])) {
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
        setcookie("MoSami_AdminUsername", encrypt($username), time()+60*60*24*365*20 , '/');
        setcookie("MoSami_AdminPass", encrypt($pass), time()+60*60*24*365*20 , '/');
      };        
    }else{
      setcookie('MoSami_AdminUsername', '', time() - 3600, '/');
      setcookie('MoSami_AdminPass', '', time() - 3600, '/');
      
    };

    $_SESSION['loggedIn'] = true;
    $_SESSION['adminname'] = $selAccRow['admin_name'];
    $_SESSION['adminid'] = $selAccRow['admin_id'];
  $res = array("status" => "success");

}
else
{
  $res = array("status" => "failed");
}




 echo json_encode($res);
 ?>