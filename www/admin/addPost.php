<?php
   session_start();

   #including functions
   include '../includes/functions.php';

   checkLogin();
   #title

   $page_title = "Add Blog Post";

   #load db connection
   include '../includes/db.php';
  
   #include header
   include 'includes/dashboard_header.php';

   $id=$_SESSION['admin_id'];


   $errors=[];

   if(array_key_exists('add', $_POST)){

   if(empty($_POST['title'])){
     $errors['title'] = "*please enter the post title";
        }

   if(empty($_POST['post'])){
          $errors['post'] = "*please enter the post title";
        }

        
    if(empty($errors)){

      $clean=array_map('trim',$_POST);
      $clean['post']=htmlspecialchars($clean['post']);

      addPost($conn,$clean,$id);

    }

   }



   ?>



   <div class="wrapper">
   <div id="stream">
   <h1 id="register-label">Add  Post</h1>
   <hr>
      <form id="register"  action ="addPost.php" method ="POST">
       <div>
          <?php
           //echo displayErrors($errors, 'title'); ?>
          <label>title:</label>
          <input type="text" name="title" placeholder="enter the post title">
       </div>
        
        <div>
         <label>Content</label>
        <textarea name="post" placeholder="Write your post........." rows="10" cols="50"></textarea>
        </div>
     
        <input type="submit"  name="add" value="post">       
   </form>

   </div>
   </div>



      
      



    <?php
   #include footer
 
   include 'includes/footer.php';

?> 
