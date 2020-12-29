<?php
include('../models/news.php');

$new_model=new News();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $new_model->news_title=$_POST['title'];
    $new_model->news_details= $_POST['details'];
    $new_model->news_image= $_POST['image'];
    $new_model->catogery=$_POST['catogery'];
    $new_model->id_category=$new_model->catogeries_id($new_model->catogery);
    $new_model->news_title=strip_tags($new_model->news_title);
    $new_model->news_details=strip_tags($new_model->news_details);

    if($new_model->addRow()){
        $feedback['code']=1250;
        $feedback['message']="data insert successfuly";
    }else{
        $feedback['code']=1251;
        $feedback['message']="failed to insert";
    }
    echo json_encode($feedback, JSON_UNESCAPED_UNICODE);

}else if($_SERVER['REQUEST_METHOD'] === 'GET'){

	if(isset($_GET['type']))
	{
        $new_model->catogery=$_GET['type'];
        $new_model->catogery=strip_tags($new_model->catogery);
        echo json_encode($new_model->typeNews($new_model->catogery), JSON_UNESCAPED_UNICODE);
	} else if(isset($_GET['id'])){
        $new_model->id=$_GET['id'];
        $new_model->id=strip_tags($new_model->id);
	    echo json_encode($new_model->getSingleRow($new_model->id), JSON_UNESCAPED_UNICODE);
    }else{
    echo json_encode($new_model->getRow(), JSON_UNESCAPED_UNICODE);   
    }
}


if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $new_model->id=$_GET['id'];
    $new_model->id=strip_tags($new_model->id);
    $new_model->news_title="update_title";
    $new_model->news_image= "update_image";
    $new_model->news_details="update_detail";
    $new_model->id_cat=4;

    if($new_model->updateRow($new_model->id)){
        $feedback['code']=1250;
        $feedback['message']="data update successfuly";
    }else{
        $feedback['code']=1251;
        $feedback['message']="failed to update";
    }
    echo json_encode($feedback, JSON_UNESCAPED_UNICODE);

}else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $new_model->id=$_GET['id'];
    $new_model->id=strip_tags($new_model->id);

    if($new_model->deleteRow($new_model->id)){
        $feedback['code']=1250;
        $feedback['message']="data delete successfuly";
    }else{
        $feedback['code']=1251;
        $feedback['message']="failed to delete";
    }
    echo json_encode($feedback['message'], JSON_UNESCAPED_UNICODE);
}
?>
