<?php
session_start();
if (isset($_SESSION['StudetnSession']) && $_SESSION['StudetnSession'] === true) {
    /** @var object $conn */
    include("../conn.php");

    function Iframe($Video_id){
        $Video_id = str_replace('https://sandbox.api.video/videos/','',$Video_id);
        $api_url ='https://sandbox.api.video/auth/api-key'; 
        $api_key = 'yFUat4l3N6XvHkbSNTE5a6DlMmhecwXnTWAP4P651Cy';
        
        $access_token = GetToken($api_url , $api_key);

        return GetIframe($Video_id , $access_token);
    };

    function GetToken($api_url , $api_key){
        $headers = array(
            "accept: application/json",
            "content-Type: application/json",
        );

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,'{"apiKey":"'.$api_key.'"}');
        $response = curl_exec($ch);

        if(curl_errno($ch)){
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);
        $json = json_decode($response);

        return $json->access_token;
    };

    function GetIframe($Video_id , $token){
        $ch = curl_init();
        curl_setopt_array($ch, array(
          CURLOPT_URL => 'https://sandbox.api.video/videos/'.$Video_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            'authorization: Bearer '.$token,
          ),
        ));
        
        $response2 = curl_exec($ch);
        
        if(curl_errno($ch)){
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);
                
        $json2 = json_decode($response2);

        return $json2->assets->player;
    };

} else {
  header("location:../index.php");
};
?>