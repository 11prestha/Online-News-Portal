<?php
    trait DataTraits{
       final public function getAllRows(){
            // select * from table
            return $this->select();
        }
        final public function selectRow($query){
            return $this->select($query);
        }

        final public function updateRow($data, $row_id){
            $args = array(
                'where'=> array(
                    'id'=> $row_id
                )
            );
            $status = $this->update($data, $args);
            if($status){
                return $row_id;
            }else{
                return false;
            }
        }

        final public function insertData($data, $is_debug = false){
            return $this->insert($data, $is_debug);
        }
    }