<?php
include('../db_config.php');

class Category{
    public $id;
    public $category;
    public $id_parent;
    public $database;

   function __construct(){

      $this->database=new DBconfig();
   }



  function getRows() {
    $pdo=$this->database->connect();
    $stmt=$pdo->prepare("select * from categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);      
  }


  function getSingleRows($id) {
     $pdo=$this->database->connect(); 
     $stmt=  $pdo->prepare("select * from categories where id=?");
     $stmt->execute([$id]);
     return $stmt->fetchAll(PDO::FETCH_OBJ);         
  }


  function getParent($id_parent) {
     $pdo=$this->database->connect();
     $stmt=  $pdo->prepare("select * from categories where id=?");
     $stmt->execute([$cat_parent]);
     return $stmt->fetchAll(PDO::FETCH_OBJ);        
  }


  function getSubTitle($id) {
     $pdo=$this->database->connect();
     $stmt=  $pdo->prepare("select * form from categories where id_parent=?");
     $stmt->execute([$id]);
     return $stmt->fetchAll(PDO::FETCH_OBJ);         
  }


  function addRow(){
   try{
     $pdo=$this->database->connect();
     $stmt=  $pdo->prepare("insert into categories values(null,?,?)");
     $stmt->execute([$this->category,$this->id_parent]);
     return true;
    }
  catch(PDOException $e){
    return false;
   }
}


 function updateRow($id) {
    try{
       $pdo=$this->database->connect();
       $stmt=  $pdo->prepare("UPDATE categories SET category=?,id_parent =? WHERE id=?");
       $stmt->execute([$this->category,$this->id_parent,$this->id]);
      return true;
     }
    catch(PDOException $e){
      return false;
     }
}


 function deletRow($id){
    try{
     $pdo=$this->database->connect(); 
     $stmt=  $pdo->prepare("DELETE FROM categories WHERE  id=?");
     $stmt->execute([$id]);
       return true;
      }
    catch(PDOException $e){
       return false;
     }
  }
}

?>