<?php if ( ! defined('ROOT')) exit; ?>

<?php
    // define as url
    $editaContato = URI . "edita/";
    $deletaContato = URI . "deleta/";

    // carrega os models
    $lista = $model->listarContatos();
    $model->insertContato();
    $model->confirmaForm = $model->deletaContato();
    $model->sem_limite = true;

    $count = 1;
?>

<div class="col-md-7" style="margin-top: 2%; margin-bottom: 6%;">
    <h5> Adicionando um novo contato</h5>

    <form method="post" class="form-group">
    
    <table class="table">
        <tr>
            <td colspan="2"> <span>Nome do contato: </span> <br>
                 <input type="text" name="nomeCliente" class="form-control" placeholder="insiria o nome..." autofocus="autofocus">
            </td>
        </tr>
        <tr>
            <td> <span>Telefone do contato: </span> <br>
                 <input type="text" name="telefoneCliente" class="form-control" placeholder="(41) 3050-1020" onkeyup="maskNumber(this, mtel);">
            </td>
            <td> <span>Celular do contato: </span> <br>
                 <input type="text" name="celularCliente" class="form-control" placeholder="(41) 98765-4321" onkeyup="maskNumber(this, mtel);">
            </td>
        </tr>
        <tr>
            <td> <span>E-mail do contato: </span> <br>
                 <input type="text" name="emailCliente" class="form-control" placeholder="insiria o email@email.com ...">
            </td>
            <td> <br> <input type="submit" name="cadastraCliente" value="CADASTRAR CONTATO" class="btn btn-success"> </td>
        </tr>
    </table>

    <?php
        echo '<p class="errorLogin">' . $model->msgForm . '</p>';
    ?>
    </form>
</div>

<div class="col-md-12">

    <?php 
        // Mensagem de configuração caso o usuário tente apagar algo
        echo $model->confirmaForm;
    ?>

	<table class="table table-hover">
    	<tr bgcolor="#DDD">
        	<td width="50"> <strong>#</strong> </td>
            <td> <strong>Contato</strong> </td>
            <td width="150"> <strong>Telefones</strong> </td>
            <td width="200"> <strong>E-mail</strong> </td>
            <td align="center"> <strong>Opções</strong> </td>
        </tr>

        <?php foreach ($lista as $contatos): ?>
            
            <tr style="font-size: 12px;">
            	<td><? echo $count++; ?></td>
            	<td>
                	<b><? echo $contatos['nomeCliente']; ?></b>
            	</td>
            	<td> <? echo $telFixo = $contatos['telefoneCliente'] == '' ? 'Telefone Fixo não informado' : $contatos['telefoneCliente'] . '<br>' . $telCelular = $contatos['celularCliente'] == '' ? 'Celular não informado' : $contatos['celularCliente']; ?> </td>
            	<td> <? echo $contatos['emailCliente']; ?> </td>
            	<td align="center"> <a href="<?php echo $deletaContato . $contatos['idCliente']; ?>" class="btn btn-danger"> deletar contato </a> </td>
        	</tr>

        <?php endforeach ?>
        
    </table>
    
</div>