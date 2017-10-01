<?php if ( ! defined('ROOT')) exit; ?>

<?php if($this->loggedIn){ echo '<script>window.location="'.HOME.'/home";</script>'; } ?>

<div id="row" style="margin-top: 15%;">
	<h4 align="center">Acesso Restrito - Agenda Telefonica</h4>
    <div class="campo_acesso col-lg-10">
    	<form method="post">
        
        <div class="form-group col-12">
        	<span>E-mail de acesso</span>
            <input type="text" name="userdata[user]" class="form-control" placeholder="ex: admin" autofocus="autofocus" />
        </div>

        <div class="form-group col-12">
            <span>Senha de acesso</span><br />
            <input type="password" class="form-control" name="userdata[user_password]" maxlength="12" />
        </div>

        <div class="form-group col-6">
            <input type="submit" class="btn btn-success" name="userdata[acessa]" value="ACESSAR" /> 
        </div>
        
        </form>
        
        <?php
            if ( $this->loginError ) {
                echo '<p class="errorLogin">' . $this->loginError . '</p>';
            }
        ?>

    </div>

    
    Não possui usuário? Clique aqui e <a class="register" href="<?php echo HOME . '/registro'; ?>">registre um usuário</a>
    
</div>