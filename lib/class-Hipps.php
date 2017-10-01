<?php
	
	class Hipps
	{
		/*
		*	$control
		*
		*	Recebera o valor do controller
		*
		*/
		private $control;

		/*
		*	$acao
		*
		*	Recebera o valor da ação
		*
		*/
		private $acao;

		/*
		*	$params
		*
		*	Recebera um array de
		*	parametros da URL.
		*
		*/
		private $params;

		/*
		*	$notFound
		*
		*	Retorna pagina 404
		*
		*/
		private $notFound = '/views/404.php';


		/*
		*	Construtor da classe
		*
		*	Recebe os valores de $control, $acao e $params e
		*	e instancia o objeto.
		*
		*/
		public function __construct () {

			// Pega valores da URL
			$this->getURL();

			// Verifica se existe o controller, caso contrario
			// chama o controller padrão
			if (! $this->control) {

				require_once ROOT . '/controllers/login-controller.php';
				$this->control = new LoginController();

				$this->control->index();
				return;
			}

			// Se o controller não exister, retorna 404.php
			if(!file_exists(ROOT . '/controllers/' . $this->control . '.php')){
				require_once ROOT . $this->notFound;

				return;
			}

			// Chama o controller
			require_once ROOT . '/controllers/' . $this->control . '.php';

			// Remove caracteres especiais
			$this->control = preg_replace("/[^a-zA-Z]/i", '', $this->control);

			// Se a classe não existir, retorna 404.php
			if (!class_exists($this->control)){
				require_once ROOT . $this->notFound;

				return;
			}

			// Cria objeto da classe
			$this->control = new $this->control($this->params);


			// Se o método existir, envia parametros
			if (method_exists($this->control, $this->acao)) {
				$this->control->{$this->acao}($this->params);

				return;
			}


			// Sem ação, chamamos o método index
			if (! $this->acao && method_exists( $this->control, 'index' )) {
				$this->control->index( $this->params );

				return;
			}

			// Página não encontrada
			require_once ROOT . $this->notFound;

			return;
		} // FIM __construct


		public function getURL() {

				// Verifica se o get 'PATH' foi enviado
			if(isset($_GET['path']) ){
				$path = $_GET['path'];

				// Limpa os dados
				$path = rtrim($path, '/');
				$path = filter_var($path, FILTER_SANITIZE_URL);

				
				// Cria um array
				$path = explode('/', $path);
				$this->control = checkArray($path, 0);
				$this->control .= '-controller';
				$this->acao = checkArray($path, 1);

				// Configura os parametros
				if(checkArray($path, 2)){
					unset($path[0]);
					unset($path[1]);
				}

				// Define que os parametros sempre venham depois da ação
				$this->params = array_values($path);

				// DEBUG
				//
				// echo $this->control . '<br>';
				// echo $this->acao        . '<br>';
				// echo '<pre>';
				// print_r( $this->params );
				// echo '</pre>';
			}
			
		} // FIM getURL
	} // FIM Hipps


?>