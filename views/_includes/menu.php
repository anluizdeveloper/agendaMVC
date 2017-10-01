<?php if ( ! defined('ROOT')) exit; ?>

<?php if ( $this->login_acess && ! $this->loggedIn ) return; ?>

<nav class="menu clearfix">
	<ul>
		<li><a href="<?php echo HOME;?>">Home</a></li>
		<li><a href="<?php echo HOME;?>/login/">Login</a></li>
	</ul>
</nav>