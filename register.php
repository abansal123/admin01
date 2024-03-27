<?php
include('security.php');
// include('database/dbconfig.php');
include('includes/header.php');
include('includes/navbar.php');
?>

    <div class="container-fluid">

    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                <form action="code.php" method="POST">

                    <div class="modal-body">
                       <div class="form-group">
                       <label >USERTYPE</label>
                            <select name="user_type" class="form-control" >
                            <option >user</option>
                            <option >admin</option>
                            </select>
                        </div>   
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                            <small class="error_email" style="color: red;"></small>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                    </div>
                </form>

                </div>
            </div>
    </div>        
        
    <div class="card shadow mb-4">
        <div class=" row card-header py-3">
            <div class="col-2">
            <h4 class="my-0 font-weight-bold text-primary">Admin Profile</h4>
            </div>
            <div class="col-4">    
            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addadminprofile">
                    Add Admin Profile 
                </button>
            <!-- <a href="Editadminregister.php" class="btn btn-primary" >
                   Edit Admin Profile
            </a> -->
            </div>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <?php
                $query = "SELECT * FROM admin_login";
                $query_run = mysqli_query($connection, $query);
            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th>UserType</th>
                            <th> Username </th>
                            <th>Email </th>
                            <th>Password</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(mysqli_num_rows($query_run) > 0)        
                        {  
                            $sr=0;
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                                $sr=$sr+1;
                        ?>
                            <tr>
                                <td><?php  echo $sr; ?></td>
                                <td><?php  echo $row['user_type']; ?></td>
                                <td><?php  echo $row['username']; ?></td>
                                <td><?php  echo $row['email']; ?></td>
                                <td><?php  echo $row['password']; ?></td>
                                
                                <td>
                                    <form action="Editadminregister.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            } 
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php 
include('includes/script.php');
include('includes/footer.php');
?>