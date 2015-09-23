<h1><?php require "includes/header.php" ?></h1>
<?php

         		foreach($authorindex_result as $row){
            		echo '<h2> About ' . $row['author_name'] .  ' </h2>' ;
					if ($row['author_level'] == 1){echo"Admin<br>";}
					echo "Registerd at $row[author_date]"; 
				
				}


        		echo '<table border="1">
              	<tr>
                <th>Last Posts</th>
                <th>Submitted at</th>
                
              	</tr>'; 
       			
       			 foreach($authorposts_result as $row1){               
   			         echo '<tr>';
   			             echo '<td class="leftpart">';
         			           echo '<h5><a href="/topic/view/' . $row1['post_topic'] . '">' . $row1['post_content'] . '</a></h5>' ;

         			       echo '</td>';
						   
        			       echo '<td class="rightpart">';     				       	  
							 echo "$row1[post_date]";
       				       echo '</td>';					
     			       echo '</tr>';
				 }
?>
<h1><?php require "includes/footer.php" ?></h1>