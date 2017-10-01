<?php
	class HomeController extends MainController
	{

		public $login_acess = true;

		public function index(){
			//Titulo da Página
			$this->title = 'Página Inicial | Agenda de Contatos';


			$params = (func_num_args() >= 1) ? func_get_arg(0) : array();

			// Carrega o model
			$model = $this->modelLoad('home/home-model');

			// Carrega o View, não precisa de Model
			require ROOT . '/views/_includes/header.php';
			require ROOT . '/views/_includes/menuLogado.php';
			require ROOT . '/views/include/home/home-view.php';
			require ROOT . '/views/_includes/footer.php';
		}

		public function novoContato(){
			//Titulo da Página
			$this->title = 'Novo Contato | Agenda de Contatos';


			$params = (func_num_args() >= 1) ? func_get_arg(0) : array();

			// Carrega o model
			$model = $this->modelLoad('home/home-model');

			// Carrega o View, não precisa de Model
			require ROOT . '/views/_includes/header.php';
			require ROOT . '/views/_includes/menuLogado.php';
			require ROOT . '/views/include/home/home-novo-view.php';
			require ROOT . '/views/_includes/footer.php';
		}
	}
?>