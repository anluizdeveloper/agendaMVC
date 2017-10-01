<?php
	class LoginController extends MainController
	{

		public function index(){
			//Titulo da Página
			$this->title = 'Página Login | Agenda de Contatos';

			$params = (func_num_args() >= 1) ? func_get_arg(0) : array();

			// Carrega o View, não precisa de Model
			require ROOT . '/views/_includes/header.php';
			require ROOT . '/views/include/login/login-view.php';
			require ROOT . '/views/_includes/footer.php';
		}
	}
?>