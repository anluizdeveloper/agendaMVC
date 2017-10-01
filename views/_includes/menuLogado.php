<?php if ( ! defined('ROOT')) exit; ?>

<?php if ( $this->login_acess && $this->loggedIn ) return; ?>

<?php
	if(isset($_GET['logout'])){
		$this->logout();

		return;
	}
?>

<div class="col-12 btn-default">
	<ul class="nav nav-pills">
		<li class="nav-item"><a class="nav-link" href="<?php echo HOME;?>/home">Home</a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo HOME;?>/home/novoContato/">Gerenciar Contatos</a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo HOME;?>/dashborad/">Dashboard</a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo HOME;?>#logout">Logout</a></li>
	</ul>
</div>