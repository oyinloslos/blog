<?php
 #including functions
include '../includes/functions.php';
#load db connection
include '../includes/db.php'; 

#include header
include 'includes/header.php';


if(isset($_GET['date'])){
   $datepost=$_GET['date'];
}

?>


    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

        <?php $show=getArchivePost($conn,$datepost);

        echo $show;
        ?>

          <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav>

        </div><!-- /.blog-main -->
         
         
      </div><!-- /.row -->

    </div><!-- /.container -->

<?php  include 'includes/footer.php';    ?>



