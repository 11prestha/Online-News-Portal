<?php
	abstract class Database{
		protected $conn	= null;
		protected $sql = null;
		protected $stmt = null;
		protected $table = null;

		public function __construct(){
			try{
				$this->conn= new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";", DB_USER, DB_PWD);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$this->sql = "SET NAMES utf8";
				$this->stmt = $this->conn->prepare($this->sql);

			}catch(PDOException $e){
				$msg= date('Y-m-d H:i:s').":PDO, Connection: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);
			}catch(Exception $e){
				$msg= date('Y-m-d H:i:s').":PDO, General, Connection: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);
			}
		}

		final protected function select($args= array(), $is_debug = false){
			try{
			// SELECT fields FROM table
			//  LEFT/RIGHT JOIN stmt
			//  WHERE clause
			//  GROUP BY clause 
			//  ORDER BY condition
			//  LIMIT start, count
                $this->sql = "SELECT ";
                
				/** field set condition */
				if(isset($args['fields']) && !empty($args['fields'])){
					if(is_string($args['fields'])){
						$this->sql .= $args['fields'];
					}else{
						$this->sql .= implode(", ", $args['fields']);
					}
				} else{
					$this->sql .= "*";
				}
				/** field set condition */

				$this->sql .= " FROM ";

				/*** Set Table */
				if(!isset($this->table) || empty($this->table)){
					throw new Exception('Table not set.');
				}
				/*** Set Table */

				$this->sql .= $this->table;

				
				/** WHERE clause */
				if(isset($args['where']) && !empty($args['where'])){
					if(is_string($args['where'])){
						$this->sql .= " WHERE ".$args['where'];
					}else{
						$temp = array();
						foreach($args['where'] as $column_name=>$value){
							$str = $column_name."= :".$column_name;
							$temp[] = $str;
					}
					$this->sql .= " WHERE ".implode(" AND ", $temp);
					}
				}
				/** WHERE clause */

				if($is_debug){
					debug($args);
					debug($this->sql);
				}

				$this->stmt = $this->conn->prepare($this->sql);

				if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
					foreach($args['where'] as $column_name=>$value){
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						} elseif(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} elseif(is_null($value)){
							$param = PDO::PARAM_NULL;
						} else{
							$param = PDO::PARAM_STR;
						}

						if($param){
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}
				$this->stmt->execute();
				$data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;

			}catch(PDOException $e){
				$msg= date('Y-m-d H:i:s').":PDO, Select: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);

			}catch(Exception $e){
				$msg= date('Y-m-d H:i:s').":PDO, General, Select: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);
			}

        }
		
		final protected function update($data= array(), $args= array(), $is_debug = false){
			try{
			//  UPDATE table SET
			//  column_name = :_key_1,
			//	column_name_2 = :_key_2
			//  WHERE clause
			//		coulmn_name = :key
			
				$this->sql = "UPDATE ";
				
				/*** Set Table */
				if(!isset($this->table) || empty($this->table)){
					throw new Exception('Table not set.');
				}
				/*** Set Table */

				$this->sql .= $this->table. " SET ";

				/** Data Set */
				if(isset($data) && !empty($data)){
					if(is_string($data)){
						$this->sql .=$data;
					}else{
						$temp_arr = array();
						foreach($data as $column_name => $value){
							$str = $column_name." = :_".$column_name;
							$temp_arr[] = $str;
						}
						$this->sql .= implode(" , ", $temp_arr);
					}
				}else{
					throw new Exception('Data not set.');
				}
				/** Data Set */

				/** WHERE clause */
				if(isset($args['where']) && !empty($args['where'])){
					if(is_string($args['where'])){
						$this->sql .= " WHERE ".$args['where'];
					}else{
						$temp = array();
						foreach($args['where'] as $column_name=>$value){
							$str = $column_name."= :".$column_name;
							$temp[] = $str;
					}
					$this->sql .= " WHERE ".implode(" AND ", $temp);
					}
				}
				/** WHERE clause */

				if($is_debug){
					debug($data);
					debug($args);
					debug($this->sql, true);
				}

				$this->stmt = $this->conn->prepare($this->sql);

				if(isset($data) && !empty($data) && is_array($data)){
					foreach($data as $column_name=>$value){
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						} elseif(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} elseif(is_null($value)){
							$param = PDO::PARAM_NULL;
						} else{
							$param = PDO::PARAM_STR;
						}

						if($param){
							$this->stmt->bindValue(":_".$column_name, $value, $param);
						}
					}
				}
				
				
				if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
					foreach($args['where'] as $column_name=>$value){
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						} elseif(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} elseif(is_null($value)){
							$param = PDO::PARAM_NULL;
						} else{
							$param = PDO::PARAM_STR;
						}

						if($param){
							$this->stmt->bindValue(":".$column_name, $value, $param);
						}
					}
				}
				return $this->stmt->execute();
				

			}catch(PDOException $e){
				$msg= date('Y-m-d H:i:s').":PDO, Update: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);

			}catch(Exception $e){
				$msg= date('Y-m-d H:i:s').":PDO, General, Update: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);
			}

		}

		final protected function insert($data= array(), $is_debug = false){
			try{
			//  INSERT INTO table SET
			//  column_name = :_key_1,
			//	column_name_2 = :_key_2
						
				$this->sql = "INSERT INTO ";
				
				/*** Set Table */
				if(!isset($this->table) || empty($this->table)){
					throw new Exception('Table not set.');
				}
				/*** Set Table */

				$this->sql .= $this->table. " SET ";
				
				/** Data Set */
				if(isset($data) && !empty($data)){
					if(is_string($data)){
						$this->sql .=$data;
					}else{
						$temp_arr = array();
						foreach($data as $column_name => $value){
							$str = $column_name." = :_".$column_name;
							$temp_arr[] = $str;
						}
						$this->sql .= implode(" , ", $temp_arr);
						
					}
				}else{
					throw new Exception('Data not set.');
				}
				/** Data Set */

				
				if($is_debug){
					debug($data);
					debug($this->sql, true);
				}

				$this->stmt = $this->conn->prepare($this->sql);
				// debug($this->stmt, true);

				if(isset($data) && !empty($data) && is_array($data)){
					foreach($data as $column_name=>$value){
						if(is_int($value)){
							$param = PDO::PARAM_INT;
						} elseif(is_bool($value)){
							$param = PDO::PARAM_BOOL;
						} elseif(is_null($value)){
							$param = PDO::PARAM_NULL;
						} else{
							$param = PDO::PARAM_STR;
						}

						if($param){
							$this->stmt->bindValue(":_".$column_name, $value, $param);
						}
					}
				}
				
				
				$this->stmt->execute();
				return $this->conn->lastInsertId();

			}catch(PDOException $e){
				$msg= date('Y-m-d H:i:s').":PDO, Insert: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);

			}catch(Exception $e){
				$msg= date('Y-m-d H:i:s').":PDO, General, Insert: ".$e->getMessage()."\r\n";
				error_log($msg, 3, ERROR_LOG);
			}

		}

		final protected function getRows($sql){
			$this->sql = $sql;
			$this->stmt = $this->conn->prepare($this->sql);
			$this->stmt->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

	}
	