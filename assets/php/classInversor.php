<?php 

	require 'database.php';
	class Inversor{	
		public function __construct(){
			$database = new Database();
			$dbSet = $database->dbSet();
			$this->conn=$dbSet;
		}
        public function index(){
            $stmt = $this->conn->prepare("SELECT * FROM `infoInversor` WHERE 1");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);   
        }
	}
	
 ?>