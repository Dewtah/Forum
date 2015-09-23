<?php

Class signinController Extends baseController {

	public function index(){
        $this->registry->template->signin_index = 'welcome in the signin page';

		
	if(isset($_SESSION['user']) ){
    	        $this->registry->template->show('category_index');
	}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        $this->registry->template->show('signin_index');
	}
    else
    {	$_POST = array_map('trim', $_POST);
        $errors = array();
         
        if(empty($_POST['user_name']))
        {
            $errors[] = 'The username field must cannot be empty.';
        }
         
        if(empty($_POST['user_pass']))
        {
            $errors[] = 'The password field must cannot be empty.';
        }
         
        if(!empty($errors)) 
        {
            echo 'Uh-oh.. a couple of fields are not filled in correctly..';
            echo '<ul>';
            foreach($errors as $key => $value) 
            {
                echo '<li>' . $value . '</li>'; 
            }
            echo '</ul>';
					header('Refresh: 3; url=/signin');
        }
        else
        {
        $db = new db;
		$db->Connection();
		$db = $db->getConnection();
    	
    	$name = ($_POST['user_name']);
		$pass = ($_POST['user_pass']);
		
            $sql = "SELECT 
                        author_id,
                        author_name,
                        author_level
                    FROM
                        author
                    WHERE
                        author_name = :name
                    AND
                        author_pass = :pass";
			
			$stmt = $db->prepare($sql);
			$stmt->bindParam (':name', $name, PDO::PARAM_STR);
			$stmt->bindParam (':pass', $pass, PDO::PARAM_STR);
                         
            $stmt->execute();
			$result = $stmt->fetchAll();
            //print_r ($result);
            if(!isset($result))
            {
                echo 'Something went wrong while signing in. Please try again later.';
            }
            else{
                if(count($result) == 0){
                    echo 'You have supplied a wrong user/password combination. Please try again.';
					header('Refresh: 3; url=signin');
                }
                else
                {
                    $_SESSION['user'] = array(
                        
                        'author_id' => $result[0]['author_id'],
                        'author_name'  => $result[0]['author_name'],
                        'author_level' => $result[0]['author_level'],
                        );
					  					
                       header('Refresh: 0; url=/category');
                }
            }
        }
    }
}
	
	
	
	
	}
}
?>