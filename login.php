<?php
session_start();
// include('security.php');
include('includes/header.php');
?>


    <!-- Begin Page Content -->
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <?php
                                            if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                                            {
                                                echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                                                unset($_SESSION['status']);
                                            }
                                        ?>
                                    </div>


                                    <form class="user" action="code.php"  method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email_log" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_log" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            
                                               <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block" >login</button>
                                           
                                        </div>
                                       <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                        <hr> -->
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="#">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    </div>
                <!-- /.container-fluid -->

<?php 
include('includes/script.php');
include('includes/footer.php');
?>

