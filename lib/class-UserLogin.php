<?php
	class UserLogin
	{
		// Boolean para verificar se está ou não logado
		public $loggedIn;

		// Dados do usuário
		public $userdata;

		// Mensagem de erro para formulário de acesso
		public $loginError;

		public $db;

		// inicia a conexao
		public function __construct( $db = false) {
			$this->db = new DBconnect();
		}

		// Verifica o login
		public function checkLogin() {

			// Verifica se existe sessão
			if(isset($_SESSION['userdata']) && ! empty($_SESSION['userdata']) 
				&& is_array($_SESSION['userdata']) && !isset($_POST['userdata']) ){

				// Configura os dados
				$userdata = $_SESSION['userdata'];
				$userdata['post'] = false;

			}

			// Verifica se existe um POST com userdata
			if(isset($_POST['userdata']) && ! empty($_POST['userdata'])
				&& is_array($_POST['userdata']) ){

				// Configura os dados
				$userdata = $_POST['userdata'];
				$userdata['post'] = true;
			}


			// Verifica se existe algum dado, se não faz logout
			if(! isset($userdata) || ! is_array($userdata)){
				$this->logout();

				return;
			}

			if(empty($userdata)){
				$this->loggedIn = false;
				$this->loginError = null;

				// Remove qualquer conexão do usuário
				$this->logout();

				return;
			} else{
				$post = true;
			}

			extract($userdata);

			// verifica se existe um usuário e senha
			if ( ! isset( $userdata['user'] ) || ! isset( $userdata['user_password'] ) ) {
				$this->loggedIn = false;
				$this->loginError = 'Erro: não foi encontrado usuário e senha para sessão';
				
				$this->logout();
			
				return;
			}

			// verifica se o user existe no database
			$query = $this->db->query('SELECT * FROM admin WHERE user = ? LIMIT 0, 1', array($userdata['user']));

			// verifica o retorno da consulta
			if(! $query){
				$this->loggedIn = false;
				$this->loginError = 'Erro interno';

				$this->logout();

				return;
			}


			// Obtém os dados do database
			$fetch = $query->fetch(PDO::FETCH_ASSOC);

			$idUser = (int) $fetch['idUser'];

			// se o ID obtido não existir, faz o logout
			if(empty($idUser)){
				$this->loggedIn = false;
				$this->loginError = 'Usuário não existe';

				$this->logout();

				return;
			}


			// verifica se a senha fornecida é compativel
			if($this->passw->CheckPassword($userdata['user_password'], $fetch['userPW']) == true){

				// verifica se o ID da sessão é compativel
				if( session_id() != $fetch['userSessionID'] && ! $post){
					$this->loggedIn = false;
					$this->loginError = 'Sessão inexistente';

					$this->logout();

					return;
				}

				if($post){
					$sessionID = session_id();

					$_SESSION['userdata'] = $fetch;
					$_SESSION['userdata']['user_password'] = $userdata['user_password'];
					$_SESSION['userdata']['userSessionID'] = $sessionID;

					// Atualiza Sessão no database
					$update = $this->db->update('admin', 'idUser', $idUser,
						array('userSessionID' => $sessionID)
					);

				}


				// usuário logado
				$this->loggedIn = true;

				$this->userdata = $_SESSION['userdata'];

				// redirecionada o usuário para pagina inicial
				// echo '<script type="text/javascript">window.location.href = "' . HOME . '/home' . '";</script>';

				// Verifica se existe uma URL para redirecionar o usuário
				
				
				return;
			} else {

				// senha incorreta
				$this->loggedIn = false;
				$this->loginError = 'Senha incorreta';

				$this->logout();

				return;
			}

		} 


		

		// Função para logout
		protected function logout($redirect = false){
			$_SESSION['userdata'] = array();
			unset($_SESSION['userdata']);
			session_regenerate_id();

			if($redirect === true){
				$this->gotoLogin();
			}
		}


		// Função redireciona para login
		protected function gotoLogin(){
			if(defined('HOME')){
				echo '<script type="text/javascript">window.location.href = "' . HOME . '";</script>';

			}

			return;
		}

		// envia para a pagina solicitada
		final protected function goto_page( $page_uri = null ) {
		if ( isset( $_GET['url'] ) && ! empty( $_GET['url'] ) && ! $page_uri ) {
			// Configura a URL
			$page_uri  = urldecode( $_GET['url'] );
		}
		
		if ( $page_uri ) { 
			// Redireciona
			echo '<meta http-equiv="Refresh" content="0; url=' . $page_uri . '">';
			echo '<script type="text/javascript">window.location.href = "' . $page_uri . '";</script>';
			//header('location: ' . $page_uri);
			return;
		}
	}
	}
?>