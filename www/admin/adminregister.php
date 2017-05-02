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
   //$errors = [];

   #form validation

 ?>
	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
  			<div>
  				<?php
  		       //echo displayErrors($errors, 'fname'); ?>
  				<label>first name:</label>
  				<input type="text" name="fname" placeholder="first name">
  			</div>
  			<div>
  				
  				<label>last name:</label>	
  				<input type="text" name="lname" placeholder="last name">
  			</div>
			    
  			<div>
  				
  				<label>email:</label>
  				<input type="text" name="email" placeholder="email">
  			</div>
			    
  			<div>
  				
  				<label>password:</label>
  				<input type="password" name="password" placeholder="password">
  			</div>
 
  			<div>
         
          <label>confirm password:</label>	
  				<input type="password" name="pword" placeholder="password">
  			</div>

			    <input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

<?php
   #include footer
 
   include 'includes/footer.php';

?>
	