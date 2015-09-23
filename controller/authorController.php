<?php

Class authorController Extends baseController {

	public function index(){

        $db = new db;
		$db->Connection();
		$db = $db->getConnection();  
			
		
        $sql = "SELECT author_id, author_name, author_date, author_email, author_level
                FROM author            
                ";

                
			
		$stmt = $db->prepare($sql);            
        $stmt->execute();
		$result = $stmt->fetchAll();
 		
	    $this->registry->template->authorindex_result = $result ;
	
 		if(!$result){
    		echo 'The authors could not be displayed, please try again later.';
						header('Refresh: 3; url=/author');
		}
	
 		else{
    		if(count($result) == 0){
        		echo 'No authors registerd yet.';
    		}
    		
  			else{
  				$this->registry->template->category_result = $result ;
				        $this->registry->template->show('author_index');
  			}
 		}

	}
	
	public function view() {
		$urlId = $this->registry->urlId;


		$db = new db;
		$db->Connection();
		$db = $db->getConnection();   	
		
		$sql = "SELECT author_id, author_name, author_date, author_email, author_level
        		FROM author
				WHERE author_id = :urlId";
		
		$stmt = $db->prepare($sql); 
		$stmt->bindParam (':urlId', $urlId, PDO::PARAM_INT);
		          
        $stmt->execute();
		$result = $stmt->fetchAll();
 		//print_r ($result);

 		if(!$result){
    		echo 'This author could not be displayed, you will be redirected to the author page shortly';
			      		header('Refresh: 3; url=/author');
		}
		else{
            if(count($result) == 0){
        		echo 'This author does not exist.';
    		}
    		else{

        		$this->registry->template->authorindex_result = $result ; 

       			$db = new db;
				$db->Connection();
				$db = $db->getConnection();
       			 
						 
				$sql = "SELECT posts.post_content, posts.post_date, posts.post_by, posts.post_topic, author.author_id, author.author_name, author.author_level, author.author_date
                		 FROM posts LEFT JOIN author
						 ON posts.post_by = author.author_id
                 		 WHERE author.author_id = :urlId
                 		 ORDER BY posts.post_date desc
                 		 LIMIT 5";		 
         
				$stmt = $db->prepare($sql); 
				$stmt->bindParam (':urlId', $urlId, PDO::PARAM_INT);
		          
       			$stmt->execute();
				$result = $stmt->fetchAll();
         
        		if(!$result){
            		echo 'This author could not be displayed because he or she did not submit a post yet. Please try again later. You will now be relocated to the author page.';
            		header('Refresh: 5; url=/author');
        		}
        		else{
            		$this->registry->template->authorposts_result = $result ;
					$this->registry->template->show('author_view');
        		}
    		}
		}
	}
}
?>