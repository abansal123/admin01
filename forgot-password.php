<?php
session_start();
// include('database/dbconfig.php');
include('includes/header.php');
?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <h3>
                                        <?php
                                            if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                                            {
                                                echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                                                unset($_SESSION['status']);
                                            }
                                            
                                        ?>
                                        </h3>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" action="code.php" method="POST" >
                                        <div class="form-group">
                                            <input type="email" name="reset_email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                        <button type="submit" name="forgotpass_btn" class="btn btn-primary btn-user btn-block" >send link</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<?php
   

?>
<?php 
include('includes/script.php');
include('includes/footer.php');
?>