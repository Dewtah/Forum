<?php

Class categoryController Extends baseController {

	public function index(){

        $db = new db;
		$db->Connection();
		$db = $db->getConnection();  
			
		
        $sql = "SELECT cat_id, cat_name, cat_description, cat_date
                FROM categories            
                ";

                
			
		$stmt = $db->prepare($sql);            
        $stmt->execute();
		$result = $stmt->fetchAll();
 		
	
 		if(!$result){
    		echo 'The categories could not be displayed, please try again later.';
		}
	
 		else{
    		if(count($result) == 0){
        		echo 'No categories defined yet.';
    		}
    		
  			else{
  				$this->registry->template->category_result = $result ;
				        $this->registry->template->show('category_index');
  			}
 		}

	}
	
	public function create(){
		if (!isset($_SESSION['user'])){
			echo 'you need to sign in first you will now be redirected to the sign in page shortly';
			header('Refresh: 3; url=/signin');
		}		
	
		elseif  ($_SESSION['user']['author_level'] != TRUE){
			echo "Your not registerd as Admin. And therefor cannot create a new category. You will now be redirected to the topics page";
			header('Refresh: 3; url=/topic');
		}	
			
		elseif($_SERVER['REQUEST_METHOD'] != 'POST'){
			$this->registry->template->show('category_create');
		}	

		else{
			$db = new db;
			$db->Connection();
			$db = $db->getConnection();
    	
   		 	$catName = ($_POST['cat_name']);
			$catDesc = ($_POST['cat_description']);
	
	        $sql = "INSERT INTO categories (cat_name, cat_description)
   		            VALUES(:catName, :catDesc)";
				
			$stmt =$db->prepare($sql);
           
			$stmt->bindParam (':catName', $catName, PDO::PARAM_STR);
			$stmt->bindParam (':catDesc', $catDesc, PDO::PARAM_STR);             
   	   	 	$stmt->execute();
				
			echo "Create category succes. You will be redirected to the category page.";	
      		header('Refresh: 3; url=/category');
    			
		}
	
	}
	public function view() {
		$urlId = $this->registry->urlId;


		$db = new db;
		$db->Connection();
		$db = $db->getConnection();   	
		
		$sql = "SELECT cat_id, cat_name, cat_description
        		FROM categories
				WHERE cat_id = :urlId";
		
		$stmt = $db->prepare($sql); 
		$stmt->bindParam (':urlId', $urlId, PDO::PARAM_INT);
		          
        $stmt->execute();
		$result = $stmt->fetchAll();
 		//print_r ($result);

 		if(!$result){
    		echo 'The category could not be displayed, you will be redirected to the category page shortly';
			      		header('Refresh: 3; url=/category');
		}
		else{
            if(count($result) == 0){
        		echo 'This category does not exist.';
    		}
    		else{

        		$this->registry->template->category_name = $result ; 

       			$db = new db;
				$db->Connection();
				$db = $db->getConnection();
       			 
       			$sql = "SELECT topic_id, topic_subject, topic_date, topic_cat
                		 FROM topics
                		 WHERE topic_cat = :urlId";
         
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
            			$this->registry->template->category_result = $result ;
						$this->registry->template->show('category_view');
              
           			}
        		}
    		}
		}
	}
}
?>