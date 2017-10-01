<?php
	class HomeModel extends MainModel
	{
		public $contatos_por_pagina = 20;
		public $control;
		public $params;
		public $msgForm;
		public $dadosForm;
		public $sem_limite;

		// instancia os objetos no construtor
		public function __construct($db = false, $control = null) {
			$this->db = $db;

			$this->control = $control;

			$this->params = $this->control->params;

			$this->userdata = $this->control->userdata;
		}


		// lista contatos
		public function listarContatos(){

			// configura a variavel
			$id = $where = $limitQuery = null;

			if ( is_numeric(checkArray($this->params, 1 )) ) {
				
				// Configura o ID para enviar para a consulta
				$id = array ( checkArray( $this->params, 1 ) );
				
				// Configura a cláusula where da consulta
				$where = " WHERE idCliente = ? ";
			}
			
			// Configura a página a ser exibida
			$pagina = ! empty( $this->params[2] ) ? $this->params[2] : 1;
			$pagina--;
			
			$contatos_por_pagina = $this->contatos_por_pagina;
			$offset = $pagina * $contatos_por_pagina;

			// defini o limite por pagina
			if( empty($this->sem_limite)){
				$limitQuery = " LIMIT $offset, $contatos_por_pagina";
			}

			// faz a consulta
			$stmt = "SELECT * FROM cliente ". $where ." ORDER BY nomeCliente ASC" . $limitQuery;

			$query = $this->db->query($stmt, $id);

			if($query){
				return $query->fetchALL();
			}
		} // FIM listarContatos


		// insere novos contatos
		public function insertContato(){

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

			
			// libera o campo cadastraCliente
			unset($_POST['cadastraCliente']);

			// organiza os values
			$nomeCliente = $this->dadosForm['nomeCliente'];
			$telefoneCliente = $this->dadosForm['telefoneCliente'];
			$celularCliente = $this->dadosForm['celularCliente'];
			$emailCliente = $this->dadosForm['emailCliente'];


			$cols = array('nomeCliente', 'telefoneCliente', 'celularCliente', 'emailCliente');
			$values = array($nomeCliente, $telefoneCliente, $celularCliente, $emailCliente);

			// se houver o parametro edita, faz o update, se não inseri
			if(checkArray($this->params, 1) == 'edita'){
				$idCliente = array ( checkArray( $this->params, 1 ) );
				$valorCampo = array('nomeCliente' => $nomeCliente, 'telefoneCliente' => $telefoneCliente, 'celularCliente' => $celularCliente, 'emailCliente' => $emailCliente);

				$insert = $this->db->update('cliente', 'idCliente', $valorCampo, $idCliente);
			} else {
				$insert = $this->db->insert('cliente', $cols, $values);
			}

			if($insert){
				$this->msgForm = 'Contato inserido com sucesso';
				echo '<meta http-equiv="refresh" content="1; url='. HOME .'/home/novoContato">';
				return;

			} else {
				$this->msgForm = 'Erro ao enviar dados' . $insert;
			}
		} // FIM insereContato


		// deleta Contato
		public function deletaContato(){

			// se nao tiver o parametro deleta, retorna
			if(checkArray($this->params, 0) != 'deleta'){
				return;
			}

			// o segundo parametro tem que ser o ID do contato, se não retorna
			if(! is_numeric(checkArray($this->params, 1) ) ){
				return;
			}


			// o terceiro parametro é a confirmação, se não retorna
			if(checkArray($this->params, 2) != 'confirma'){
				$mensagem  = '<div class="alert alert-danger" role="alert">';
				$mensagem .= '<p> Deseja deletar o cliente? <a href="' . URI . 'confirma" class="btn btn-warning">Sim</a>  <a href="' . HOME . '/home/novoContato" class="btn btn-light">Não</a></p>';
				$mensagem .= '</div>';
			
				// Retorna a mensagem e não excluir
				return $mensagem;
			}

			// guarda o ID do contato
			$idCliente = checkArray($this->params, 1);

			// realiza o delete
			$delete = $this->db->delete('cliente', 'idCliente', $idCliente);

			if($delete){
				echo '<script type="text/javascript">window.location.href = "' . HOME . '/home/novoContato";</script>';
			} else {
				echo 'Erro';
			}
		}
	}
?>