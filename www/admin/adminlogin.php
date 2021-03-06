
<?php
   session_start();
    #title
   $page_title = "Login";

   #include header
   include 'includes/header.php';
   #load db connection

   include '../includes/db.php';

   #including functions
   include '../includes/functions.php';


   #errors
   $errors=[];

   #validate form

   if(array_key_exists('register', $_POST)) {
   
        #validate email

      if(empty($_POST['email'])){
         $errors['email'] = "*please enter a email address </br>" ; 
      }

      if(empty($_POST['password'])){
         $errors['password'] = "*Please enter a password </br>";

      }

       

      if(empty($errors)) {
         //do database stuff

         #eliminate unwanted spaces from values in the $_POST array
         $clean = array_map('trim', $_POST);

         $chk = adminLogin($conn,$clean);
        

            $row = $chk[1];

            #set user session..
            $_SESSION['admin_id'] = $row['admin_id'];
            //$_SESSION['admin_name'] = $row['firstName'];

            # redirect...
            redirect('addPost.php');
         

      }

   }
   
?>
    
   <div class="wrapper">
      <h1 id="register-label">Admin Login</h1>
      <hr>
      <form id="register"  action ="adminlogin.php" method ="POST">
         <?php
            $errmsg = displayErrors($_GET, 'msg');
            echo $errmsg;
         ?>
         <div>
            <?php
               $errmsg = displayErrors($errors,'email');
               echo $errmsg;
            ?>
            
            <label>email:</label>
            <input type="text" name="email" placeholder="email">
         </div>
         <div>
            <?php
               $errmsg = displayErrors($errors,'password');

               echo $errmsg;
            ?>
            
            <label>password:</label>
            <input type="password" name="password" placeholder="password">
         </div>

         <input type="submit" name="register" value="login">
      </form>

      <h4 class="jumpto">Don't have an account? <a href="adminregister.php">register</a></h4>
   </div>

<?php
   #include footer
 
   include 'includes/footer.php';

?>
   