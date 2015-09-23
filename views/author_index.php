<h1><?php require "includes/header.php" ?></h1>
<?php

        		echo '<table border="1">
              	<tr>
                <th>Authors</th>
                <th>Registerd at</th>
                
              	</tr>'; 
       			
       			 foreach($authorindex_result as $row){               
   			         echo '<tr>';
   			             echo '<td class="leftpart">';
         			           echo '<h3><a href="author/view/' . $row['author_id'] . '">' . $row['author_name'] . '</a></h3>' ;

         			       echo '</td>';
						   
        			       echo '<td class="rightpart">';     				       	  
							  if ($row['author_level'] == 1){echo"$row[author_date] Admin";}
							  else{echo "$row[author_date]";}
       				       echo '</td>';					
     			       echo '</tr>';
				 }
?>
<h1><?php require "includes/footer.php" ?></h1>