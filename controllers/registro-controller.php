<?php
	class RegistroController extends MainController
	{
		
		public $login_acess = false;


		public function index(){
			//Titulo da Página
			$this->title = 'Cadastro de Usuário | Agenda de Contatos';

			$params = (func_num_args() >= 1) ? func_get_arg(0) : array();

			// Carrega o model
			$model = $this->modelLoad('registro/registro-model');

			// Carrega o View, não precisa de Model
			require ROOT . '/views/_includes/header.php';
			require ROOT . '/views/include/registro/registro-view.php';
			require ROOT . '/views/_includes/footer.php';
		}
	}
?>