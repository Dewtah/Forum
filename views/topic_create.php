
<h1><?php require "includes/header.php" ?></h1>
<?php

               		echo '<form method="post" action="">
                   		Subject: <input type="text" name="topic_subject" />
                   		Category:'; 
						            
             		echo '<select name="topic_cat">';

               		     foreach($category_result as $row){
           			echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    	}
                	echo '</select>'; 
                     
                	echo 'Message: <textarea name="post_content" /></textarea>
                   		 <input type="submit" value="Create topic" />
                 	 	 </form>';

?>
<h1><?php require "includes/footer.php" ?></h1>