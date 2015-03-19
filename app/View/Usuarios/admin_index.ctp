<div class="btn-group">
<?php echo $this->Html->link('Novo Usuario',array('controller'=>'Usuarios','action'=>'add'),array('class'=>'btn btn-info ttip','title'=>'Adiciona um novo usuário','data-step'=>'1','data-intro'=>'Caso queira que outra pessoa tenha acesso a este painel, você pode clicar aqui para cadastrar os dados, ou...')) ;?>
<?php echo $this->Html->link('Permissões',array('controller'=>'Usuarios','action'=>'lista_grupo'),array('class'=>'ttip btn','title'=>'Gerenciar grupos de permissões','data-step'=>'2','data-intro'=>'Permite especificar a que recurso cada grupo de usuário terá acesso.')) ;?>
</div>
<hr />
<div class="pagina-controller">
<?php echo $this->Session->flash(); ?>
    <table class="table-ajax table table-striped table-hover table-bordered" data-step="4" data-intro="E aqui você tem a listagem de usuário criados anteriormente, você pode criar editar os dados de qualquer usuário ou, até mesmo, remover um deles se quiser.">
        <thead>
            <tr>
            	<th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th class="actions">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($retorno as $value):
			$i++;
		?>
            <tr>
            	<td><?php echo $i;?></td>
                <td><?php echo $value['Usuario']['nome'];?></td>
                <td><?php echo $value['Usuario']['email'];?></td>
                <td class="table-acoes">
                <div class="btn-group">
                	<?php
					echo $this->Html->link(
						'<i class="icon-cogs"></i> Editar',
						array('controller'=>'Usuarios','action'=>'add',$value['Usuario']['id']),
						array('escape'=>false,'class'=>'btn ttip ','title'=>'Editar '.$value['Usuario']['nome'])
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i> Remover',
						array('controller'=>'Usuarios','action'=>'remove',$value['Usuario']['id']),
						array('escape'=>false,'class'=>'btn btn-danger ttip confirm','title'=>'Apagar  '.$value['Usuario']['nome'].' definitivamente!')
					);?>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
            	<th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
</div>
<hr />
<div class="btn-group">
<?php echo $this->Html->link('Novo Usuario',array('controller'=>'Usuarios','action'=>'add'),array('class'=>'btn btn-info ttip','title'=>'Adiciona um novo usuário','data-step'=>'3','data-intro'=>'Ou aqui, já que eles fazem a mesma coisa!')) ;?>
<?php echo $this->Html->link('Permissões',array('controller'=>'Usuarios','action'=>'lista_grupo'),array('class'=>'ttip btn','title'=>'Gerenciar grupos de permissões')) ;?>
</div>