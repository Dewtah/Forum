<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>My Personal Forum</title>
    <link rel="stylesheet" href="/views/includes/style.css" type="text/css">
</head>
<body>
<h1>The daily life forum</h1>
    <div id="wrapper">
    <div id="menu">
        <a class="item" href="/">Home</a> -
        <a class="item" href="/category">View category</a> -
        <a class="item" href="/Author">Author index</a> -       
        <a class="item" href="/topic/create">Create a topic</a>
        
        <div id="userbar">
    		<?php
    		if (isset($_SESSION['user']))
    		{
        	echo 'Hello ' . $_SESSION['user']['author_name'] . '. Not you? <a class="item" href="/signout">Sign out</a>';
				if ($_SESSION['user']["author_level"] == '1'){
					echo ' or <a class="item" href="/category/create">Create a category</a>';
				}	
    		}
    		else
    		{
			echo '<form method="post" action="signin">
            	Username: <input type="text" name="user_name" /><br>
           		Password: <input type="password" name="user_pass"><br>
            	<input type="submit" value="Sign in" />
        		 or <a href="/signup">create an account</a>.</form>';
    		} 
    		?>
		</div>
        <div id="content">