<?php 

class DBconfig{
	private  $host="localhost";
	private  $db_name="news_db";
	private  $db_user="root";
	private  $db_passward="";
	private $pdo;


	function __construct(){

	  try{ 
		   $this->pdo=new PDO("mysql:host=$this->host;dbname=$this->db_name",$this->db_user,$this->db_passward);
		   $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	   }
		catch(Exception $ex){  
			Echo "Connection failed" . $ex->getMessage();  
		}  
	}

	function  connect(){
	return $this->pdo;
	}
}

 ?>