<?php
include('security.php');
// include('database/dbconfig.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
    </div>
    <div class="card-body">
    <?php

if(isset($_POST['edit_btn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM admin_login WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>

                    <form action="code.php" method="POST">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                        <label >USERTYPE</label>
                            <select name="edituser_type" class="form-control" >
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                            </select>
                        </div>   
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control"
                                placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control"
                                placeholder="Enter Email">
                        </div>

                        <a href="register.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="edit_updatebtn" class="btn btn-primary"> Update </button>

                    </form>
                    <?php
                }
            }
        ?>
    </div>
</div>
</div>



<?php 
include('includes/script.php');
include('includes/footer.php');
?>