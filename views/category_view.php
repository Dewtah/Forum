<h1><?php require "includes/header.php" ?></h1>
<?php


         				foreach($category_name as $row){
            				echo '<h2> Topics in ' . $row['cat_name'] .  ' category</h2>' ;
						}

                		echo '<table border="1">
                      		  <tr>
                        	  <th>Topic</th>
                      		  <th>Created at</th>
                     		  </tr>'; 

                     
        				foreach($category_result as $row){               												 
                     		echo '<tr>';
                    		    echo '<td class="leftpart">';
									echo '<h3><a href="/topic/view/' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                  		      echo '</td>';
							  echo '<td class="rightpart">';
									echo "$row[topic_date]";
									//echo "$row[post_by]";
                  		      
                       		 	echo '</td>';
                   			 echo '</tr>';
						}

?>
<h1><?php require "includes/footer.php" ?></h1>