<?php

	class RegistroModel
	{
		// define variaveis
		public $db;
		public $dadosForm;
		public $msgForm;


		// inicia a conexao
		public function __construct( $db = false) {
			$this->db = new DBconnect();
		}


		public function registroUser() {

			// confira array para dados do formulário
			$this->dadosForm = array();

			// verifica se o formulario foi envido
			if('POST' == $_SERVER['REQUEST_METHOD'] && ! empty($_POST)){

				// obtem dados do formulario
				foreach ($_POST as $key => $value) {
					$this->dadosForm[$key] = $value;

					// se houver campos vazios, retorna erro
					if(empty($value)){
						$this->msgForm = 'FALHA: Preencha todos os campos.';

						return;
					}
				}
			} else {
				return;
			}

			if(empty($this->dadosForm)){
				$this->msgForm = 'FALHA: não foi enviado o formulário';

				return;
			}


			// verifica se o usuario já existe
			$query = $this->db->query('SELECT * FROM admin WHERE user = ? LIMIT 0, 1', array($this->dadosForm['user']));

			if(! $query){
				$this->msgForm = 'Erro interno';

				return;
			}

			$fetch = $query->fetch(PDO::FETCH_ASSOC);

			$idUser = $fetch['idUser'];

			if(! empty($idUser)){
				$this->msgForm = 'Usuário existente, tente outro nome';

				return;
			} else {

				$newUser = $this->dadosForm['user'];
				$userSessionID = md5(time());

				// faz o hash da senha
				$password_hash = new PasswordHash(8, FALSE);
				$password = $password_hash->HashPassword( $this->dadosForm['password'] );

				$cols = array('user', 'userPW', 'userSessionID');
				$values = array($newUser, $password, $userSessionID);

				$insert = $this->db->insert('admin', $cols, $values);


				if(! $insert){
					$this->msgForm = 'Erro interno. Falha na Insersão.';

					return;
				} else {
					$this->msgForm = 'Usuário cadastrado com sucesso!';

					return;
				}
			}
		} // FIM registroUser
	} // FIM RegistroModel
	
?>