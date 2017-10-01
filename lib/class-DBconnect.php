<?php
	class DBconnect
	{
		public 	$host,
				$db_name,
				$password,
				$user,
				$charset,
				$pdo,
				$error,
				$debug,
				$last_id;

				public function __construct(
					$host		= null,
					$db_name	= null,
					$password	= null,
					$user		= null,
					$charset	= null,
					$debug		= null
				){
					$this->host 	= defined('HOST') 		? HOST : $this->host;
					$this->db_name 	= defined('DB') 		? DB : $this->db_name;
					$this->password = defined('DB_PASS') 	? DB_PASS : $this->password;
					$this->user 	= defined('DB_USER')	? DB_USER : $this->user;
					$this->charset 	= defined('DB_CHARSET')	? DB_CHARSET : $this->charset;
					$this->debug 	= defined('DEBUG')		? DEBUG : $this->debug;

					$this->connect();
				} // FIM __construct


		// Conexão PDO
		final protected function connect(){

			// Conexão PDO
			$pdoDetails = "mysql:host={$this->host};";
			$pdoDetails .= "dbname={$this->db_name};";
			$pdoDetails .= "charset={$this->charset};";

			// bloco try
			try {
				$this->pdo = new PDO($pdoDetails, $this->user, $this->password);

				unset( $this->host     );
				unset( $this->db_name  );
				unset( $this->password );
				unset( $this->user     );
				unset( $this->charset  );
			} catch(PDOException $e) {

				// verifica se há necessidade de debugar
				if ( $this->debug === true ) {
					echo "Erro: " . $e->getMessage();
				}

				// finaliza o arquivo
				die();
			}
		}



		// Consulta PDO
		public function query($stmt, $data = null){
			$query = $this->pdo->prepare($stmt);
			$query->execute($data);

			// verifica a consulta, se ok retorna
			if($query){
				return $query;
			} else {
				$error = $query->errorInfo();
				$this->error = $error[2];

				return false;
			}
		}


		// Inserção de valores
		public function insert($table, $cols, $values){
			$col = '';
			$value = '';
			$data = count($cols);

			// organiza as colunas e valores
			for($i = 0; $i < $data; $i++){
				$col .= $cols[$i];
				$value .= "'" . $values[$i];

				if($i == $data-1){
					$col .= "";
					$value .= "'";
				}else{
					$col .=", ";
					$value .= "',";
				}
			}

			$stmt = 'INSERT INTO `'.$table.'` ('.$col.') VALUES ('.$value.')';

			// envia o insert
			$insert = $this->pdo->query($stmt, $data);

			// verifica se foi feito o insert
			if($insert){
				return $insert;
			} else {
				return;
			}

		} // FIM insert



		// Atualização de valores
		public function update($table, $campo, $valorCampo, $valores) {
			if(empty($table) || empty($campo) || empty($valorCampo) ){
				return;
			}

			$stmt = "UPDATE `$table` SET ";
			$set = array();

			$where = "WHERE `$campo` = ? ";

			// se não houver array com valores, retorna
			if(! is_array($valores) ){
				return;
			}

			foreach ($valores as $cols => $valor) {
				$set[] = "`$cols` = ?";
			}

			// separa as colunas por virgula
			$set = implode(', ', $set);

			$stmt .= $set . $where;
			$valores[] = $valorCampo;
			$valores = array_values($valores);

			// realiza o update
			$update = $this->query($stmt, $valores);

			if($update){
				return $update;
			}

			return;
		} // FIM update



		// Delete valores
		public function delete($table, $campo, $valorCampo){
			if(empty($table) || empty($campo) || empty($valorCampo) ){
				return;
			}

			$stmt = "DELETE FROM `$table` ";
			$where = " WHERE `$campo` = ? ";

			$stmt .= $where;

			$valores = array($valorCampo);
			$delete = $this->query($stmt, $valores);

			if($delete){
				return $delete;
			}

			return;
		} // FIM delete

	}
?>