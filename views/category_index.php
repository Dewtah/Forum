<h1><?php require "includes/header.php" ?></h1>
<?php

        		echo '<table border="1">
              	<tr>
                <th>Category</th>
                <th>Created at</th>
              	</tr>'; 
       			
       			 foreach($category_result as $row){               
   			         echo '<tr>';
   			             echo '<td class="leftpart">';
         			           echo '<h3><a href="category/view/' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
         			       echo '</td>';
						   
        			       echo '<td class="rightpart">';
       				       	  echo "$row[cat_date]";
       				       echo '</td>';					
     			       echo '</tr>';
				 }
?>
<h1><?php require "includes/footer.php" ?></h1>