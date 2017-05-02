<?php
   session_start();
   #including functions
   include '../includes/functions.php';

   checkLogin();
   #title

   $page_title = "View Post";

   #load db connection
   include '../includes/db.php';
   #include header
   include 'includes/dashboard_header.php';


   ?>


   <div class="wrapper">
		<div id="stream">

		    <table id="tab">
			    <thead>
					<tr>
						
						<th>Post Title</th>
						<th>Post</th>
						<th>date created</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>

				   <?php $view=viewPost($conn);
				   echo $view;
				   ?>

          		</tbody>
			</table>
		</div>
				
			
</div>

<?php
	
	include 'includes/footer.php';

?>