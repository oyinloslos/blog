<?php
   #title

   $page_title = "Register";

   #load db connection
   include '../includes/db.php';


   #including functions
   include '../includes/functions.php';

   #include header
   include 'includes/header.php';


   #cache errors
   $errors = [];

   #form validation

   if(array_key_exists('register', $_POST)) {
    
        
        #validate first name 
        if(empty($_POST['fname'])){
          $errors['fname'] = "*please enter a first name ";
        }

        
        if(empty($_POST['lname'])) {
          $errors['lname'] = "*please enter a last name ";

        }

        if(empty($_POST['email'])){
          $errors['email'] = "*please enter a email address " ; 
        }
        

        if(empty($_POST['password'])){
          $errors['password'] = "*Please enter a password ";

        }
        if (empty($_POST['pword'])){
            $errors['pword'] = "*Please confirm password";
        }

        if ($_POST['pword'] != $_POST['password'])
        {
            $errors['pword'] = "*Passwords do not match.";
        }


        if(usersEmailExistence($conn, $_POST['email'])) {

          $errors['email'] = "*email already exists";
        }


        if(empty($errors)) {

         
          //do database stuff
        #eliminate unwanted spaces from values in the $_POST array
        $clean = array_map('trim', $_POST);
        $hash = password_hash($clean['password'], PASSWORD_BCRYPT);
         #hash the password

        $clean['password'] = $hash;
        
        #register admin
        dbAdminRegister($conn,$clean);
        
      
        }
    }   
?>
  <div class="wrapper">
    <h1 id="register-label">Admin Register</h1>
    <hr>
    <form id="register"  action ="adminregister.php" method ="POST">
        <div>
          <?php
             echo displayErrors($errors, 'fname'); ?>
          <label>first name:</label>
          <input type="text" name="fname" placeholder="first name">
        </div>
        <div>
          <?php
            echo displayErrors($errors, 'lname');  ?>
          <label>last name:</label> 
          <input type="text" name="lname" placeholder="last name">
        </div>
          
        <div>
          <?php
           echo displayErrors($errors, 'email'); ?>
          <label>email:</label>
          <input type="text" name="email" placeholder="email">
        </div>
          
        <div>
          <?php
            echo displayErrors($errors, 'password'); ?>

          <label>password:</label>
          <input type="password" name="password" placeholder="password">
        </div>
 
        <div>
          <?php
            echo displayErrors($errors, 'pword'); ?>

          <label>confirm password:</label>  
          <input type="password" name="pword" placeholder="password">
        </div>

          <input type="submit" name="register" value="register">
    </form>

    <h4 class="jumpto">Have an account? <a href="adminlogin.php">login</a></h4>
  </div>

<?php
   #include footer
 
   include 'includes/footer.php';

?>
  