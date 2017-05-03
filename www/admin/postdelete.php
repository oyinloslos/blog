<?php

   session_start();
   #including functions
   include '../includes/functions.php';

   checkLogin();
   
   #load db connection
   include '../includes/db.php';



   if(isset($_GET['post_id'])) {
      
   # DATA ACCESS OBJECT DESIGN PATTERN....
        $postid= $_GET['post_id'];
   }
      



deletePost($conn,$postid);




?>