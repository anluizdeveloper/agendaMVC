<?php if ( ! defined('ROOT')) exit; ?>

<?php
    $contatos_por_pagina = 20;
    
    $lista = $model->listarContatos();
    $count = 1;
?>

<div class="col-md-12">
	<table class="table table-hover">
    	<tr bgcolor="#DDD">
        	<td width="50"> <strong>#</strong> </td>
            <td width="200"> <strong>Contato</strong> </td>
            <td> <strong>Telefones</strong> </td>
            <td width="240"> <strong>E-mail</strong> </td>
        </tr>

        <?php foreach ($lista as $contatos): ?>
            
            <tr style="font-size: 12px;">
            	<td><? echo $count++; ?></td>
            	<td>
                	<b><? echo $contatos['nomeCliente']; ?></b>
            	</td>
            	<td> <? echo $telFixo = $contatos['telefoneCliente'] == '' ? 'Telefone Fixo não informado' : $contatos['telefoneCliente'] . ' | ' . $telCelular = $contatos['celularCliente'] == '' ? 'Celular não informado' : $contatos['celularCliente']; ?> </td>
            	<td> <? echo $contatos['emailCliente']; ?> </td>
        	</tr>

        <?php endforeach ?>
        
    </table>
    
</div>