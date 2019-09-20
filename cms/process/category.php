<?php
    require '../../config/init.php';
    require '../inc/checklogin.php';
    $category = new Category();

    if(isset($_POST) && !empty($_POST)){
        $data = array(
            'title'=>sanitize($_POST['title']),
            'summary'=>sanitize($_POST['summary']),
            'status'=>sanitize($_POST['status']),
            'added_by'=>$_SESSION['user_id']
        );
        
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $file_name = uploadSingleImage($_FILES['image'], "category");
            if($file_name){
                $data['image'] = $file_name;
            }
        }
        //debug($data, true);
        $status = $category->insertData($data);
        if($status){
            redirect('../category.php', 'success', 'Category Added Successfully');
        }else{
            redirect('../category.php', 'error', 'Sorry! There was error while adding category.');
        }
    }else{
        redirect('../category.php', 'error', 'Add Category First');
    }