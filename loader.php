<?php
	// Evita acesso direto no arquivo
	if (!defined ('ROOT')) exit;

	// função para criar e validar sessão
	function sec_session_start() {
	    $session_name = 'userdata';   // Estabeleça um nome personalizado para a sessão
	    
	    // Estabelece o nome fornecido acima como o nome da sessão.
	    session_name($session_name);
	    session_start();            // Inicia a sessão PHP 
	    session_regenerate_id();    // Recupera a sessão e deleta a anterior. 
	}

	sec_session_start();

	// Verifica o DEBUG
	if (!defined ('DEBUG') || DEBUG == false){

		// Exibição de Erros FALSE
		error_reporting(0);
		ini_set("display_errors", 0);

	} else {
		
		// Exibição de Erros FALSE
		error_reporting(E_ALL);
		ini_set("display_errors", 1);

	}

	// Chama as funções
	require_once ROOT . '/lib/functions.php';

	// Iniciando Aplicação
	$agendaCliente = new Hipps();

?>