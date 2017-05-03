
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>
	<section>
		<div class="mast">
			<h1>T<span>SSB</span></h1>
			<nav>
				<ul class="clearfix">
					<li><a href="viewPost.php"<?php currNav("viewPost.php"); ?>>View Posts</a></li>
					<li><a href="addPost.php"<?php currNav("addPost.php"); ?>>Add Post</a></li>
					<li><a href="logout.php"<?php currNav("logout.php"); ?>>Logout</a></li>
					
			</nav>
		</div>
	</section>