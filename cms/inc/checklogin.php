<?php
$user = new User();
    if(!isset($_SESSION, $_SESSION['token']) || empty($_SESSION['token'])){
        if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){
            $cookie_token = $_COOKIE['_au'];
            $user_info = $user->getUserByCookie($cookie_token);
            //debug($user_info, true);

            if(!$user_info){
                setcookie('_au','',time()-60, '/');
                redirect('./', 'error', 'Please login first.');
            }

            $_SESSION['user_id'] = $user_info[0]->id;
            $_SESSION['name'] = $user_info[0]->name;
            $_SESSION['email'] = $user_info[0]->email;

            $token = randomString(100);
            $_SESSION['token'] = $token;
           
                setcookie('_au', $token, (time()+864000), '/');
                $data = array(
                    'remember_token'=> $token
                );
                $user->updateRow($data, $user_info[0]->id);

        }else{
            redirect('./', 'error', 'Access Denied.');
        }
    }