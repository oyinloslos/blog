<?php

   #including functions
   include '../includes/functions.php';

   checkLogin();
   #title

   $page_title = "Register";

   #load db connection
   include '../includes/db.php';
  
   #include header
   include 'includes/header.php';

   ?>


   <div class="wrapper">
    <h1 id="register-label">view</h1>
    <hr>