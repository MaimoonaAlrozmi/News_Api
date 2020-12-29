<?php
include('../db_config.php');

class News{
    public $id;
    public $news_title;
    public $news_details;
    public $news_image;
    public $news_date;
    public $id_category;
    public $database;
    public $catogery;

function __construct(){

    $this->database=new DBconfig();
  }


function getRow(){
    $pdo=$this->database->connect();
    $smt=$pdo->prepare("select * from news");   
    $smt->execute();
    return $smt->fetchAll(PDO::FETCH_OBJ);    
  }


function getSingleRow($id){
    $pdo=$this->database->connect();
    $smt=$pdo->prepare("select * from news where id=?");
    $smt->execute([$this->id]);
    return $smt->fetchAll(PDO::FETCH_OBJ);
}

function typeNews($catogery){
    $pdo=$this->database->connect();
    $smt=$pdo->prepare("select * FROM news WHERE id_cat IN(select id FROM `categories` WHERE category=?)");
    $smt->execute([$this->catogery]);
    $rows=$smt->fetchAll(PDO::FETCH_OBJ);
    return $rows;
}


function addRow(){
  try{  $pdo=$this->database->connect();
    $smt=$pdo->prepare('insert into news values(null,?,?,?,now(),?)');
    $smt->execute([$this->news_title,$this->news_image,$this->news_details,$this->id_cat]);
   return true;
    }
    catch(Exception $e){  
        return false; 
    }  
}  


function updateRow($id){
   try{ 
       $pdo=$this->database->connect();
       $smt=$pdo->prepare("UPDATE news SET title=?,details=?,image=?, date=now(), category_id=? WHERE id=?");
       $smt->execute([$this->news_title,$this->news_details,$this->news_image,$this->id_cat,$this->id]);
       return true;
    }
    catch(Exception $e){   
        return false; 
    } 
} 


function deleteRow($id){
  try{  
    $pdo=$this->database->connect();
    $smt=$pdo->prepare("DELETE FROM news WHERE id=?");
    $smt->execute([$this->id]);
    return true;
    }
    catch(Exception $e){   
        return false; 
    } 
}

public function catogery_id($catogery){

    $pdo=$this->database->connect();
    $smt=$pdo->prepare("select id from categories where category=?");
    $smt->execute([$this->catogery]);
    $rows=$smt->fetchAll(PDO::FETCH_OBJ); 
    
   foreach($rows as $row){
       $content['id']=$row->id;
    }
   
   return $content['id'];
  }

}

?>