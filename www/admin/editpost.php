<?php
   
   session_start();
   #including functions
   include '../includes/functions.php';

   checkLogin();
   

   #load db connection
   include '../includes/db.php';

    #include header
   include 'includes/dashboard_header.php';


   if(isset($_GET['post_id'])) {
      
   # DATA ACCESS OBJECT DESIGN PATTERN....
        $postid= $_GET['post_id'];
   }
       $item = getPostByID($conn, $postid);


        //$id=$_SESSION['admin_id'];


   $errors=[];

   if(array_key_exists('edit', $_POST)){

   if(empty($_POST['title'])){
     $errors['title'] = "*please enter the post title";
        }

   if(empty($_POST['post'])){
          $errors['post'] = "*please enter the post title";
        }

        
    if(empty($errors)){

      $clean=array_map('trim',$_POST);
     

      $clean['post']=htmlspecialchars($clean['post']);

     editPost($conn,$clean,$postid);

     redirect('viewPost.php');
    }

   }



   ?>



   <div class="wrapper">
   <div id="stream">
   <h1 id="register-label">Edit  Post</h1>
   <hr>
      <form id="register"  action ="<?php echo 'editpost.php?post_id='.$postid ; ?>" method ="POST">
       <div>
          <label>title:</label>
          <input type="text" name="title" value="<?php echo $item['title'];?>">
       </div>
        
        <div>
         <label>Content</label>
        <textarea name="post" placeholder="Write your post........." rows="10" cols="50" ><?php echo  $item['body'];?></textarea>
        </div>
     
        <input type="submit"  name="edit" value="post">       
   </form>

   </div>
   </div>



      
<?php
   #include footer
 
   include 'includes/footer.php';

?> 

   


