<?php


Class topicController Extends baseController {

	public function index() {
              			header('Refresh: 0; url=/category');            
	}

	public function create() {


		if (!isset($_SESSION['user'])){
    		echo 'Sorry, you have to be signed in to create a topic. You will be redirected to the sign in page shortly';
			header('Refresh: 3; url=/signin');
		}
		else{
    		if($_SERVER['REQUEST_METHOD'] != 'POST'){   

				$db = new db;
				$db->Connection();
				$db = $db->getConnection();   	
		
				$sql = "SELECT cat_id, cat_name, cat_description
						FROM categories";
			
				$stmt = $db->prepare($sql);            
       		 	$stmt->execute();
				$result = $stmt->fetchAll();


    					if(count($result) == 0){
                   			echo 'Before you can post a topic, you must wait for an admin to create some categories.';	
           				}
						
           				else{
							$this->registry->template->category_result = $result ;
							$this->registry->template->show('topic_create');
            			}
			}
			else{
						$db = new db;
						$db->Connection();
						$db = $db->getConnection();
						
            			$sql = "INSERT INTO topics(topic_subject, topic_cat, topic_by)
                   				VALUES  (:topSub, :topCat, :authorId)";
						
    					$topSub = ($_POST['topic_subject']);
						$topCat = ($_POST['topic_cat']);
						$authorId = $_SESSION['user']['author_id']; 
				
						$stmt =$db->prepare($sql);
           
						$stmt->bindParam (':topSub', $topSub, PDO::PARAM_STR);
						$stmt->bindParam (':topCat', $topCat, PDO::PARAM_STR);             
   	   	 				$stmt->bindParam (':authorId', $authorId, PDO::PARAM_STR);
   	   	 				$stmt->execute();
                      
                				$topicid = $db->lastInsertId();
                 
                				$sql2 = "INSERT INTO posts(post_content, post_topic, post_by)
										 VALUES (:post_content, :topic_id, :author_id)";
              					
								$post_content = $_POST['post_content'];
								$authorId = $_SESSION['user']['author_id'];
								
								$stmt = $db->prepare($sql2);
								
								$stmt->bindParam (':post_content', $post_content, PDO::PARAM_STR);
								$stmt->bindParam (':topic_id', $topicid, PDO::PARAM_STR);
								$stmt->bindParam (':author_id', $authorId, PDO::PARAM_STR);
								
								$stmt->execute();
			                    
									 
                    	        header("Refresh: 0; url=/category/view/$topCat");

        			
    		}
 		 }  
	}
	
		public function view() {
		$urlId = $this->registry->urlId;


		$db = new db;
		$db->Connection();
		$db = $db->getConnection();   	
		
		$sql = "SELECT topic_id, topic_subject
        		FROM topics
				WHERE topic_id = :urlId";
		
		$stmt = $db->prepare($sql); 
		$stmt->bindParam (':urlId', $urlId, PDO::PARAM_INT);
		          
        $stmt->execute();
		$result = $stmt->fetchAll();
 		//print_r ($result);

 		if(!$result){
    		echo 'The topics could not be displayed, you will be redirected to the category page shortly';
			header('Refresh: 3; url=/category');
		}
		else{
            if(count($result) == 0){
        		echo 'This topic does not exist.';
    		}
    		else{

	       		$this->registry->template->topic_name = $result ; 

       			$db = new db;
				$db->Connection();
				$db = $db->getConnection();
       			 
       			$sql = "SELECT posts.post_topic, posts.post_content, posts.post_date, posts.post_by, author.author_id, author.author_name
                		 FROM posts LEFT JOIN author
						 ON posts.post_by = author.author_id
                 		 WHERE posts.post_topic = :urlId";
         
				$stmt = $db->prepare($sql); 
				$stmt->bindParam (':urlId', $urlId, PDO::PARAM_INT);
		          
       			$stmt->execute();
				$result = $stmt->fetchAll();
         
        		if(!$result){
            		echo 'The topics could not be displayed, please try again later.';
        		}
        		else{
            		if(count($result) == 0){
                		echo 'There are no topics in this category yet.';
            		}
            		else{
            			$this->registry->template->topic_result = $result ;
						$this->registry->template->show('topic_view');
              
           			}
        		}
    		}
		}
	}
}

?>
