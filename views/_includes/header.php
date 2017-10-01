<?php if ( ! defined('ROOT')) exit; ?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="pt-BR">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="pt-BR">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="pt-BR">
<!--<![endif]-->

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">

	<!-- CSS Styles -->
	<link rel="stylesheet" href="<?php echo HOME;?>/views/_css/style.css">
	<link rel="stylesheet" href="<?php echo HOME;?>/views/_css/bootstrap.css">

	<!-- JS Scripts -->
	<script type="text/javascript" src="<?php echo HOME; ?>/views/_js/script.js"></script>
	<script type="text/javascript" src="<?php echo HOME; ?>/views/_js/bootstrap.js"></script>

	<!--[if lt IE 9]>
	<script src="<?php echo HOME;?>/views/_js/scripts.js"></script>
	<![endif]-->

	<title><?php echo $this->title; ?></title>
</head>
<body>

<div class="container-fluid">