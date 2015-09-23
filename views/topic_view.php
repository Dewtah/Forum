<h1><?php require "includes/header.php" ?></h1>
<?php


         				foreach($topic_name as $row){
            				echo '<h2> Posts in ' . $row['topic_subject'] .  ' topic</h2>' ;
						}

                		echo '<table border="1">
                      		  <tr>
                        	  <th>Author</th>
                      		  <th>Reply</th>
                     		  </tr>'; 

                     
        				foreach($topic_result as $row2){               												 
                     		echo '<tr>';
		 	     		    	echo '<td class="leftposts">';
									echo "<h4>$row2[author_name]<h4>";
									echo "$row2[post_date]";
									//echo '<a href="/topic/view/' . $row2['author_name'] . '">' . $row2['post_date'] . '</a>';
                  		    	echo '</td>';
                    			echo '<td class="rightposts">';
									echo "<h5>$row2[post_content]<h5>";
                  	        		echo '</td>';
							echo '</tr>';
						}
						echo '<table border="1">
                      		  <tr>
                      		  <th><h1>Reply:<h1></th>
                     		  </tr>';
							  
						echo '<td class="post-content">';
						echo '<form method="post" action="/post/create/'.$row['topic_id'].'">
   							<textarea name="reply_content"></textarea>
    						<input type="submit" value="Submit reply" />
							</form>';
						echo '</td>';

?>
<h1><?php require "includes/footer.php" ?></h1>