<?php
// session_start();
include('database/dbconfig.php');
include('includes/header.php');

if(isset($_GET['email']) && isset($_GET['forgot_token']))
{
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date("Y-m-d H:i:s");

    $query = "SELECT * FROM admin_login WHERE email='{$_GET['email']}' AND forgot_token='{$_GET['forgot_token']}' AND exper_token > '$current_time'";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run) == 1)
    {

        // HTML code for new password form
        echo "<div class='container'>
        <!-- Outer Row -->
        <div class='row justify-content-center'>

            <div class='col-xl-10 col-lg-12 col-md-9'>

                <div class='card o-hidden border-0 shadow-lg my-5'>
                    <div class='card-body p-0'>
                        <!-- Nested Row within Card Body -->
                        <div class='row'>
                            <div class='col-lg-6 d-none d-lg-block bg-password-image'></div>
                            <div class='col-lg-6'>
                                <div class='p-5'>
                                    <div class='text-center'>
                                        <h1 class='h4 text-gray-900 mb-2'>New Password?</h1>
                                        <h3>
                                        </h3>
                                        <p class='mb-4'>We get it, stuff happens. Just enter your Create new password!</p>
                                    </div>
                                    <form class='user' action='code.php' method='POST' >
                                        <div class='form-group'>
                                        <input type='hidden' name='reset_emailpass' class='form-control form-control-user'
                                            aria-describedby='emailHelp' value='$_GET[email]'>
                                        </div>
                                        <div class='form-group'>
                                            <input type='password' name='new_pass' class='form-control form-control-user'
                                                 aria-describedby='emailHelp'
                                                placeholder='Enter new pass...'>
                                        </div>
                                        <div class='form-group'>
                                            <input type='password' name='new_cpass' class='form-control form-control-user'
                                                 aria-describedby='emailHelp'
                                                placeholder='Enter Confirm pass...'>
                                        </div>
                                        <div class='form-group'>
                                        <button type='submit' name='newpass_btn' class='btn btn-primary btn-user btn-block' >create password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>";
    }
    else
    {
        echo "<script>
                alert('Database error.');
                window.location.href = 'login.php';
              </script>";
    }
}
else
{
    echo "<script>
            alert('Database 222error.');
            window.location.href = 'login.php';
          </script>";
}

include('includes/script.php');
include('includes/footer.php');
?>
