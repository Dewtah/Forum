<?php

Class signupController Extends baseController {

	public function index(){
        $this->registry->template->forum_heading = 'This is the forum Index';

		
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
        	$this->registry->template->show('signup_index');
		}
		else{
			$errors = array(); 
				
				if(!empty($_POST['user_name'])){
        				
        			if(!ctype_alnum($_POST['user_name'])){
            				
            			$errors[] = 'The username can only contain letters and digits.';
        			}
        			if(strlen($_POST['user_name']) > 30){
            			$errors[] = 'The username cannot be longer than 30 characters.';
        			}
    			}
    			else{
        			$errors[] = 'The username field must not be empty.';
    			}
         
    			if(!empty($_POST['user_pass'])){
        			if($_POST['user_pass'] != $_POST['user_pass_check']){
            			$errors[] = 'The two passwords did not match.';
        			}
    			}
    			else{
        			$errors[] = 'The password field cannot be empty.';
    			}
				if(empty($_POST['user_email'])){
                    $errors[] = 'You must submit a valid Email adress.';
    			}

    				if(!empty($errors)){
        				echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        				echo '<ul>';
        				foreach($errors as $key => $value){
            				echo '<li>' . $value . '</li>'; 
        				}
        				echo '</ul>';
						header('Refresh: 3; url=signup');
    				}
					
 						else{
						$db = new db;
						$db->Connection();
						$db = $db->getConnection();
    	
    					$name = $db->quote($_POST['user_name']);
						$pass = $db->quote($_POST['user_pass']);
						$email = $db->quote($_POST['user_email']);
 
        				$sql = " INSERT INTO author (author_name, author_pass, author_email)
                		VALUES(".$name.", ".$pass.", ".$email.")";
                         
        				$db->exec($sql);
						
        				if(!isset($db)){
							echo 'Something went wrong while registering. Please try again later.';
            			}
        				else{
            				$this->registry->template->signup_succes = 'Successfully registered. You can now <a href="signin">sign in</a> and start posting! :-)';
        					$this->registry->template->show('signup_succes');
						}
    				}
			}
	}
}
?>
