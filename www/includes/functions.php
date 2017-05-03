<?php

   function checkLogin(){

        if(!isset($_SESSION['admin_id'])){
          redirect('adminlogin.php');

        }
      } 

  function displayErrors($arr,$key) {

			if(isset($arr[$key])) {
				echo '<span class="err">'.$arr[$key]. '</span>';
			}

		}

 function dbAdminRegister($dbconn,$input) {
        #insert data
      	$stmt = $dbconn->prepare("INSERT INTO admin(firstName, lastName, email, hash) VALUES(:fn, :ln, :e, :h)");

        #bind params
      	$data = [
      		':fn' => $input['fname'],
      		':ln' => $input['lname'],
      		':e'  => $input['email'],
      		':h'  => $input['password']
      	];

      		$stmt->execute($data);

         }

    function usersEmailExistence($dbconn,$email) {
        	$result = false;

        	$stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:e");
        	#bind parameters
        	$stmt->bindparam(":e", $email);
        	$stmt->execute();

        	#get number of rows returned

        	$count = $stmt->rowCount();

        	if($count > 0){
        		$result = true;
        	}

        		return $result;

      }
    
     

     function adminLogin($dbconn,$input){
          $result = [];

    			$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :e");
      		$stmt->execute([":e" => $input['email']]);

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

      	  #get number of rows returned
      	  $count = $stmt->rowCount();

      	   if($count != 1 || !password_verify($input['password'], $row['hash'])) {
              
              # handle error
              redirect('adminlogin.php?msg=either username or password is incorrect');

              exit();
            } else {
              $result[] = true;
              $result[] = $row['admin_id'];
      	    }

           return $result;

      }


      function redirect($loc){

      	header("location:".$loc);
      }



       function currNav($page){
        $currPage = basename($_SERVER['SCRIPT_FILENAME']);

        if($currPage==$page){
          echo 'class="selected"';
        }

      }



      function addPost($dbconn,$input,$adminID){

      	$stmt=$dbconn->prepare("INSERT INTO blogPost(admin_id,title,body,date_posted) VALUES(:ai,:ti,:b, NOW())");

      	$stmt->bindParam(":ai", $adminID);
      	$stmt->bindParam(":ti", $input['title']);
      	$stmt->bindParam(":b", $input['post']);


      	$stmt->execute();

      }

      function getpost($dbconn){

      $stmt=$dbconn->prepare("SELECT * FROM  blogPost ");

      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

       return $row;

      }


      function insertIntoArchive($dbconn){

        $row = getpost($dbconn);

        $stmt=$dbconn->prepare("INSERT INTO archive(post_id,date_posted) VALUES(:pi,:d)");

        $stmt->bindParam(":pi",$row['post_id']);
        $stmt->bindParam(":d", $row['date_posted']);
       
        $stmt->execute();

      }
      
      function viewPost($dbconn){

            $result = "";

			$stmt = $dbconn->prepare("SELECT * FROM blogPost");
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
				$result .= '<tr><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td>
				<td><a href="editpost.php?post_id='.$row[0].'">edit</a></td>
				<td><a href="postdelete.php?post_id='.$row[0].'">delete</a></td></tr>';
			}

			return $result;
		

      }

      function editPost($dbconn,$input,$postID){


			$stmt =$dbconn->prepare("UPDATE blogPost SET title=:ti, body=:b WHERE post_id=:post_id");

			$data = [
				":ti" => $input['title'],
				":b" => $input['post'],
				":post_id" => $postID

			];

			$stmt->execute($data);
			
			
		
      }
     
     function getPostByID($dbconn,$postID){

     	$stmt=$dbconn->prepare("SELECT * FROM  blogPost WHERE post_id=:pi");

     	$stmt->bindParam(":pi", $postID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

       return $row;

      }



      function deletePost($dbconn,$postID){

        
         $stmt=$dbconn->prepare("DELETE FROM blogPost WHERE post_id=:post_id");
         
         $stmt->bindparam(":post_id", $postID);

         $stmt->execute();

         redirect('viewPost.php');

       }

       function getAdmin($dbconn,$adminID){

       	$stmt=$dbconn->prepare("SELECT * FROM  admin WHERE admin_id=:ai");

     	$stmt->bindParam(":ai", $adminID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

       return $row;

      }

       
 

       function displayPost($dbconn){
      	$result="";
       	$stmt=$dbconn->prepare("SELECT admin_id,title,body,DATE_FORMAT(date_posted,'%M %d, %Y') AS d FROM blogPost");
       	
       	$stmt->execute();

       	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
       		
       		$row1=getAdmin($dbconn,$row['admin_id']);
 
       		
       	$result.= '<h2 class="blog-post-title">'.$row['title'].'</h2>';
        $result.= '<p class="blog-post-meta">'.$row['d']. " by ".'<a href=" ">'.$row1['firstname'].'</a></p>';
        $result.= htmlspecialchars_decode($row['body']);


         }
       	

         return $result; 


       }


       function viewArchive($dbconn){
        $result="";
       $stmt=$dbconn->prepare("SELECT DISTINCT post_id,DATE_FORMAT(date_posted, '%M %Y') AS d FROM archive");

       $stmt->execute();

       while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){

        //$row1=getPostByID($dbconn,$row['post_id']);

        $result.= '<li><a href="archive.php">'.$row['d'].'</a></li>';

       }
       return $result;

       }








?>