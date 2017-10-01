<?php if ( ! defined('ROOT')) exit; ?>

<?php
    $model->registroUser();
?>

<div id="row" style="margin-top: 15%;">
	<h4 align="center">Cadastro de Usuário - Agenda Telefonica</h4>
    <div class="campo_acesso col-8">
    	<form method="post" action="">
        
        <div class="form-group col-12">
        	<span>Nome do Usuário</span>
            <input type="text" name="user" class="form-control" placeholder="ex: admin" autofocus="autofocus" />
        </div>

        <div class="form-group col-12">
            <span>Senha de acesso</span><br />
            <input type="password" class="form-control" name="password" maxlength="12" />
        </div>

        <div class="col-12">
            <input type="submit" class="btn btn-success" name="cadastro" value="CADASTRAR" />
            <a href="<?php echo HOME; ?>">voltar ao início</a>
        </div>
        
        </form>
        
        <?php
                echo '<p class="errorLogin">' . $model->msgForm . '</p>';
        ?>

    </div>
    
</div>