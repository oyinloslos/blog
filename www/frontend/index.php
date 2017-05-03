

<?php
 #including functions
include '../includes/functions.php';
#load db connection
include '../includes/db.php'; 

#include header
include 'includes/header.php';

?>
    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

        <?php $view=displayPost($conn); 
              echo $view;
        ?>

          <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav>

        </div><!-- /.blog-main -->
         
         <?php  include 'includes/sidebar.php'; ?>

      </div><!-- /.row -->

    </div><!-- /.container -->

<?php  include 'includes/footer.php';    ?>
