<?php
    final class Category extends Database{
        use Datatraits;
        public function __construct(){
            parent::__construct();
            $this->table = 'categories';
        }
    }