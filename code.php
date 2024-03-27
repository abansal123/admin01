<?php
include('security.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



if(isset($_POST['registerbtn'])){   
    $usertype = $_POST['user_type'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query = "SELECT * FROM admin_login WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO admin_login (username,email,password,user_type) VALUES ('$username','$email','$password','$usertype')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}

if(isset($_POST['edit_updatebtn'])){
    $id = $_POST['edit_id'];
    $usertype = $_POST['edituser_type'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];

    $query = "UPDATE admin_login SET username='$username', email='$email' , user_type='$usertype' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}

if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM admin_login WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}

if(isset($_POST['login_btn'])){

    $email_login = $_POST['email_log']; 
    $password_login = $_POST['password_log'];

    $query = "SELECT * FROM admin_login WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);
    $login_type = mysqli_fetch_array($query_run);

    if($login_type['user_type'] == 'user'){
        $_SESSION['username'] = $email_login;
        header('Location: https://www.hiitambala.com/');

    }elseif($login_type['user_type'] == 'admin'){
            $_SESSION['username'] = $email_login;
            header('Location: index.php');
    }else
    {
            $_SESSION['status'] = "Email / Password is Invalid";
            header('Location: login.php');
    }
        
}

if(isset($_POST['forgotpass_btn'])){
    $email_forgot = $_POST['reset_email']; 

    $query = "SELECT * FROM admin_login WHERE email='$email_forgot' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run) == 1) 
    {
        $forgot_token = bin2hex(random_bytes(16));
        date_default_timezone_set('Asia/kolkata');
        $exper_token = date("Y-m-d H:i:s", time()+60*30);
       
        $query = "UPDATE `admin_login` SET `forgot_token`='$forgot_token', `exper_token`='$exper_token' WHERE `email`='$email_forgot'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            $password_change_link = "http://localhost/adminpanel/new-password.php?email=$email_forgot&forgot_token=$forgot_token"; 
            try {
                $mail = new PHPMailer(true);

                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'intership319@gmail.com';                   
                $mail->Password   = 'mynkrcqrexvtinxi';                              
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
                $mail->Port       = 465;                                   
                //Recipients
                $mail->setFrom('intership319@gmail.com', 'Mailer');
                $mail->addAddress($email_forgot);    

                //Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'Password Reset';
                $mail->Body    = "Please click the following link to reset your password: <br>
                                <a href='$password_change_link'>Click here to reset your password</a>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo  "<script>
                            alert('Please check your email for password reset instructions.');
                            setTimeout(function() {
                                window.location.href = 'login.php'; // Redirect after 1 second
                            }, 1000); // 1000 milliseconds = 1 second
                        </script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            // Update query failed
            echo "<script>
                  alert('Password reset failed. Please try again later.');
                  setTimeout(function() {
                    window.location.href = 'login.php'; // Redirect after 1 second
                }, 1000); // 1000 milliseconds = 1 second
                  </script>";
        }
    } else {
        // Email not found
        echo "<script>
              alert('Email not found.');
              setTimeout(function() {
                window.location.href = 'login.php'; // Redirect after 1 second
            }, 1000); // 1000 milliseconds = 1 second
              </script>";
    }
}

if(isset($_POST['newpass_btn'])) { 

    $restemail= $_POST['reset_emailpass'];
    $newpass = $_POST['new_pass'];
    $newcpass = $_POST['new_cpass'];

    if($newpass == $newcpass)
    {
        $query = "UPDATE `admin_login` SET   `password`='$newcpass',  `forgot_token`=null, `exper_token`=null  WHERE `email`='$restemail'";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo "<script>
            alert('password update Successful.');
            setTimeout(function() {
              window.location.href = 'login.php'; // Redirect after 1 second
          }, 1000); // 1000 milliseconds = 1 second
            </script>"; 
        }else{
            echo "<script>
                alert('Password reset failed. Please try again later.');
                setTimeout(function() {
                window.location.href = 'login.php'; // Redirect after 1 second
            }, 1000); // 1000 milliseconds = 1 second
                </script>";
        }   
    }else{
        echo "<script>
        alert('Password reset failed. Please try again later.');
        setTimeout(function() {
          window.location.href = 'login.php'; // Redirect after 1 second
      }, 1000); // 1000 milliseconds = 1 second
        </script>";
    }

}
else{
    echo "<script>
    alert('db not found/work pls try some time after.');
    setTimeout(function() {
      window.location.href = 'login.php'; // Redirect after 1 second
  }, 1000); // 1000 milliseconds = 1 second
    </script>";
}





























?>