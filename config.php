<?php
	// CONFIGURAÇÕES GERAIS
	
	// Caminho pasta raiz
	define('ROOT', dirname(__FILE__));
	
	// Caminho para HOME
	define('HOME', '/agenda');

	// Caminho URI
	define('URI', $_SERVER['REQUEST_URI'] . '/');

	// Caminho pasta uploads
	define('UPLOADS', ROOT . '/views/storage');

	// HOST Banco de dados
	define('HOST', 'localhost');

	// DataBase
	define('DB', 'agenda');

	// Usuário DataBase
	define('DB_USER', 'root');

	// Senha DataBase
	define('DB_PASS', '');

	// CharSet para Conexão PDO
	define('DB_CHARSET', 'utf8');

	// Para desenvolvimento
	define('DEBUG', true);


	// Chama o Loader da Aplicação
	require_once ROOT . '/loader.php';
?>