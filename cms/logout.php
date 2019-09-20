<?php  
    require '../config/init.php';
    $user = new User();
    if(isset($_COOKIE['_au']) && !empty($_COOKIE['_au'])){
        setcookie('_au','', time()-60, '/');
        $data = array('remember_token'=> '');
        $user->updateRow($data, $_SESSION['user_id']);
    }
    
    session_destroy();
    redirect('./');