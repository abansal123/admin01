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
        <h6 class="m-0 font-weight-bold text-primary"> EDIT Faculty Profile </h6>
    </div>
    <div class="card-body">
    <?php

if(isset($_POST['edit_empbtn']))
{
    $id = $_POST['emp_id'];
    
    $query = "SELECT * FROM faculty WHERE emp_id ='$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>

                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="emp_id" value="<?php echo $row['emp_id'] ?>">
                        <div class="form-group">  
                        <div class="form-group">
                            <label> pic </label>
                            <input type="file" name="edit_emppic" value="<?php echo $row['emp_picture'] ?>" class="form-control"
                                placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="edit_empname" value="<?php echo $row['emp_name'] ?>" class="form-control"
                                placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="edit_empemail" value="<?php echo $row['emp_email'] ?>" class="form-control"
                                placeholder="Enter Email">
                        </div>

                        <a href="Faculty.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="emp_updatebtn" class="btn btn-primary"> Update </button>

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