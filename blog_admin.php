<?php
include('security.php');
// include('database/dbconfig.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

<div class="modal fade" id="addblog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Blog </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                
                            </div>
            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                   <div class="form-group">
                        <label>blog_picture </label>
                        <input type="file" name="blog_pic" id="emp_pic" class="form-control">
                    </div> 
                    <div class="form-group">
                        <label>blog_title</label>
                        <input type="text" name="blog_title" class="form-control" placeholder="Enter blog_title">
                    </div>  
                    <div class="form-group">
                        <label> blog_name </label>
                        <input type="text" name="blog_name" class="form-control" placeholder="blog_name">
                    </div>
                    <div class="form-group">
                        <label>blog_des</label>
                        <input type="text" name="blog_des" class="form-control checking_email" placeholder="blog_des">
                        <small class="error_email" style="color: red;"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="blogadd_btn" class="btn btn-primary">Save</button>
                </div>
            </form>

            </div>
        </div>
</div>        
    
<div class="card shadow mb-4">
    <div class=" row card-header py-3">
        <div class="col-3">
        <h4 class="my-0 font-weight-bold text-primary">Faculty Profile</h4>
        </div>
        <div class="col-4">    
        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addblog">
                Add blog
            </button>
        <!-- <a href="Editadminregister.php" class="btn btn-primary" >
               Edit Admin Profile
        </a> -->
        </div>   
    </div>
    <div class=" row card-body">
        <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
            {
                echo '<h4 class="bg-danger text-white"> '.$_SESSION['status'].' </h4>';
                unset($_SESSION['status']);
            }
        ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            
        <?php
            $query = "SELECT * FROM blog";
            $query_run = mysqli_query($connection, $query);
        ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            
                <thead>
                    <tr>
                        <th>id</th>
                        <th>blog Picture</th>
                        <th>blog des</th>
                        <th>blog Name </th>
                        <th>blog title </th>                    
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
                            <td><?php  echo '<img  src="blog_img/'.$row['blog_img'].'"  width="80px"  alt="img">'?></td>
                            <td><?php  echo $row['blog_title']; ?></td>
                            <td><?php  echo $row['blog_name']; ?></td>
                            <td><?php  echo $row['blog_des']; ?></td>
                            
                            <td>
                                <form action="editfaculty.php" method="post">
                                    <input type="hidden" name="emp_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_empbtn" class="btn btn-success"> EDIT</button>
                                </form>
                            </td>
                            <td>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="delete_blog" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete_blogbtn" class="btn btn-danger"> DELETE</button>
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