<?php
include('database/dbconfig.php');
include('includes/header01.php');
include('includes/navbar01.php');
?>
    <main>
        <!-- ============abt-01 Section  Start============ -->
        
        <section class="abt-01">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading-wrapper">
                            <h3>Blog</h3>
                            <ol>
                                <li>Hmoe<i class="far fa-angle-double-right"></i></li>
                                <li>Blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============bg-se-05  Section  Start============ -->
        
        <section class="bg-se-05">
            <div class="container">
                <div class="row">
                    <div class="heading">
                        <h2>Latest News</h2>
                    </div>
                </div>
                <?php
                            $query = "SELECT * FROM blog";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <?php
                            if(mysqli_num_rows($query_run) > 0)        
                            {  
                                while($row = mysqli_fetch_assoc($query_run))
                            {
                            ?>
                <div class="row">
                    <div class="col-4 ">
                        <article class="_lk_bg_sd_we">
                       
                            <div class="_bv_xs_we">
                                <?php  echo '<img  src="blog_img/'.$row['blog_img'].'"alt="img">'?>
                            </div>
                            <div class="_xs_we_er">
                                <div class="_he_w">
                                    <h3><?php  echo $row['blog_title']; ?></h3>
                                    <ol>
                                        <li><span>by</span><?php  echo $row['blog_name']; ?><span class="_mn_cd_xs">August 20, 2020</span></li>
                                    </ol>
                                    <p><?php  echo $row['blog_des']; ?></p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php
                        } 
                    }
                    else {
                        echo "No Record Found";
                    }
                    ?>
        
                    
        </section>

   
    </main>

    <!-- ============Footer  Start============ -->
<?php
include('includes/script01.php');
include('includes/footer01.php');
?>