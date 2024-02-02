<?php
session_start();
 /** @var object $conn */
 include("../conn.php");
 extract($_POST);
 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $selStudent = $conn->query("SELECT * FROM student_tbl WHERE Stu_Email='$Stu_Email'");
        if($selStudent->rowCount() > 0){
            $StuInfo = $conn->query("SELECT * FROM student_tbl WHERE Stu_Email='$Stu_Email'")->fetch(PDO::FETCH_ASSOC);
            $stuid = $StuInfo['stu_id'];
            $token = bin2hex(random_bytes(15));
            $selRequest = $conn->query("SELECT * FROM reset_password WHERE stu_id='$stuid'");
            if($selRequest->rowCount() > 0){
                $res = array("status" => "failed" , "msg" => "You have sent a request to reset your password before.", "stu_email" => $Stu_Email);
            }else{
                $insrequest = $conn->query("INSERT INTO reset_password(token_id, stu_id) VALUES('$token','$stuid') ");
                if($insrequest){
                        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = $_SERVER['REQUEST_URI'];
                        $url = $protocol . "://" . $host;
                        $resetLink = $url ."/home.php?page=Reset&token=". $token;

                        $getemailinfo = $conn->query("SELECT * FROM site_setting WHERE order_name='send_email'")->fetch(PDO::FETCH_ASSOC);

                        $SiteEmail = $getemailinfo['order_save'];
                        $SiteEmailPassword = $getemailinfo['order_save2'];

                        $message = 'Hi there,' . "\r\n\r\n";
                        $message .= '<br>Please click on the following link to reset your password:' . "\r\n";
                        $message .= $resetLink . "\r\n\r\n";
                        $message .= '<br>If you did not request a password reset, please ignore this email.' . "\r\n\r\n";
                        $message .= '<br>Best regards,' . "\r\n";
                        $message .= '<br>QUIZLET';

                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = $SiteEmail;
                        $mail->Password = $SiteEmailPassword;
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        $mail->setFrom($SiteEmail);
                        $mail->addAddress($Stu_Email);
                        $mail->isHTML(true);
                        $mail->Subject = 'Reset Student Password';
                        $mail->Body = $message;
                        $mail->send();
                    $res = array("status" => "success", "stu_email" => $Stu_Email);
                }else{
                    $res = array("status" => "failed", "msg" => "There's an error , please try again." ,"stu_email" => $Stu_Email);
                };
            };
        }else{
            $res = array("status" => "failed", "msg" => "This email does not exist." , "stu_email" => $Stu_Email);
        };
    echo json_encode($res);
  }else{
    header("location:../index.php");
  }
?>