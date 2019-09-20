<?php
    require "../../config/init.php";
    $user = new User();

    if(isset($_POST) && !empty($_POST)){
        
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                
        if(!$email){
            redirect('../','error','Invalid credential');
        }

        $enc_pwd = sha1($email.$_POST['password']);
             

        $user_info = $user->getUserByEmail($email);
                

        if($user_info){
            if($user_info[0]->password == $enc_pwd){
                if($user_info[0]->role == 'admin'){
                // debug($user_info);

                    $_SESSION['user_id'] = $user_info[0]->id;
                    $_SESSION['name'] = $user_info[0]->name;
                    $_SESSION['email'] = $user_info[0]->email;

                    $token = randomString(100);
                    $_SESSION['token'] = $token;
                    if(isset($_POST['remember_me'])){
                        setcookie('_au', $token, (time()+864000), '/');
                        $data = array(
                            'remember_token'=> $token
                        );
                        $user->updateRow($data, $user_info[0]->id);
                    }

                    redirect('../dashboard.php', 'success', 'Welcome to Admin Panel.');
                }elseif($user_info[0]->role == 'reporter'){
                    echo "I'm the reporter";    //reporter
                }else{
                redirect('../','error','You do not have permission to access the admin panel.');            
                }
            }else{
                redirect('../','error','User Credential does not match.');
            }
        }else{
        redirect('../','error','User Credential does not match.');
        }
        
    }else{
        redirect('../','error','Please Login First.');
    }

?>