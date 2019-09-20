<?php
    final class User extends Database{
        use DataTraits;

        public function __construct(){
            parent::__construct();
            $this->table = 'users';
        }

        public function getUserByEmail($email){
          $query = array(
            // 'fields' => 'id, status, email, name, password',
             //'fields' => ['id', 'status', 'email', 'name', 'password'],
            // 'where' => "email = '".$email."'",
             'where' => array(
                 'email' => $email,
                 'status' => "active"
            )
          );
            return $this->select($query, true);
        }

        public function getUserByCookie($cookie_token){
          $query = array(
            // 'fields' => 'id, status, email, name, password',
             //'fields' => ['id', 'status', 'email', 'name', 'password'],
            // 'where' => "email = '".$email."'",
             'where' => array(
                 'remember_token' => $cookie_token,
                 'status' => "active"
            )
          );
          return $this->select($query);
        } 
    }