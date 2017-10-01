<?php
	class MainController extends UserLogin
	{
		/*
		*
		*	Conexão com DB, mantendo o PDO
		*/
		public $db;

		/*
		*
		*	Gerador de senhas
		*/
		public $passw;

		/*
		*
		*	Titulo das páginas
		*/
		public $title;

		/*
		*
		*	Verifica se a página precisa de login
		*/
		public $login_acess = false;

		/*
		*
		*	Parametros
		*/
		public $params;

		public function __construct ($params = array() ){

			// Instancia a conexão
			$this->db = new DBconnect();

			// Senha
			$this->passw = new PasswordHash(8, false);

			// Parametros
			$this->params = $params;

			// Check login
			$this->checkLogin();
		} // FIM construct



		// Carrega os Models
		public function modelLoad($model = false){

			// Deverá enviar um arquivo
			if (!$model) return;

			// Garante letras minusculas no nome do arquivo
			$model = strtolower($model);

			// Caminho do Model
			$modelPath = ROOT . '/models/' . $model . '.php';

			// Verifica se o arquivo existe
			if (file_exists($modelPath) ) {

				// Inclui o arquivo
				require_once $modelPath;

				// Remove os caminhos existentes
				$model = explode('/', $model);

				// Pega o nome final do arquivo
				$model = end($model);

				// Remove caracteres invalidos
				$model = preg_replace('/[^a-zA-Z0-9]/is', '', $model);

				// Verifica a existencia da classe
				if(class_exists($model)){
					return new $model($this->db, $this);
				}

				return;
			}

		}


	} // FIM MainController
?>