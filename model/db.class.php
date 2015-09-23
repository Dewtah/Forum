<?php
class db{

    protected $db;

    public function Connection(){

    $conn = NULL;

        try{
            $conn = new PDO("mysql:host=localhost;dbname=forum", "root", "0623285634");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage();
                }    
            $this->db = $conn;
    }
    
    public function getConnection(){
        return $this->db;
    }
	private function __clone(){
	}
}

?>