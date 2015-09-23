<?php

Class postController Extends baseController {

	public function index(){
	      $this->registry->template->show('category_index');	
	}
	
		public function create(){
	    if($_SERVER['REQUEST_METHOD'] != 'POST'){
    		echo 'Please select a category and topic first. You will be redirected shortly';
			header('Refresh: 3; url=/category');			
		}
		else{
    		if(!isset($_SESSION['user'])){
        		echo 'You must be signed in to post a reply. You will be redirected to the Sign In page shortly.';
				header('Refresh: 3; url=/signin');
    		}
    		else{
    							$db = new db;
								$db->Connection();
								$db = $db->getConnection();  
				
				
								$sql = "INSERT INTO posts(post_content, post_topic, post_by)
								     	VALUES (:post_content, :topic_id, :author_id)";
									 
              					$urlId = $this->registry->urlId;
								$post_reply = $_POST['reply_content'];
								$authorId = $_SESSION['user']['author_id'];
								
								$stmt = $db->prepare($sql);
								
								$stmt->bindParam (':post_content', $post_reply, PDO::PARAM_STR);
								$stmt->bindParam (':topic_id', $urlId, PDO::PARAM_STR);
								$stmt->bindParam (':author_id', $authorId, PDO::PARAM_STR);
								
								$stmt->execute();
                         
            					echo 'Your reply has been saved, check out the topic</a>.';
								header("Refresh: 3; url=/topic/view/$urlId");
        
    }
}  
	}
	
	
}