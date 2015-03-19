<div class="row-fluid">
    <div class="span12">
    	<legend>Categorias</legend>
    </div>
</div>
<div class="btn-group">
<?php echo $this->Html->link('Nova categoria',array('model'=>$categoria_pai,'controller'=>'Categorias','action'=>'add'),array('class'=>'btn btn-info','title'=>'Criar nova categoria','data-step'=>'1','data-intro'=>'Neste botão você consegue incluir rapidamente uma nova categoria de fotos no seu site, você ainda tem um outro botão igual a esse no fim da página.')) ;?>
<?php echo $this->Html->link('Gerenciar galerias',array('controller'=>'Galerias','action'=>'index'),array('class'=>'btn','title'=>'Voltar para galerias','data-step'=>'2','data-intro'=>'Já este botão vai te levar direto para o gerenciamento de galerias, existe outro botão como este no fim da página, clique em Próximo para saber aonde.')) ;?>
</div>
<hr />
<div class="pagina-controller">
<?php echo $this->Session->flash(); ?>
    <table class="table-ajax table table-striped table-hover table-bordered" data-step="4" data-intro="Nesta tabela você encontra a listagem de categorias disponíveis no seu site e organizadas da forma que vão aparecer.">
        <thead>
            <tr>
            	<th>#</th>
                <th>Titulo da categoria</th>
                <th class="actions">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$i=0;
			foreach($retorno as $value):
			$i++;
			if($i==1){
		?>
            <tr>
            	<td data-step="5" data-intro="Este número representa a ordem atual da categoria que você está vendo, apenas um guia pra facilitar a visualização."><?php echo $i;?></td>
                <td data-step="6" data-intro="Este é o nome da sua categoria, assim, além de saber aonde você está, ainda pode usar a caixa de pesquisa no canto superior direito para encontrar o que precisa!"><?php echo $value['Categoria']['titulo'];?></td>
                <td class="table-acoes" data-step="7" data-intro="Você também tem acesso a 4 recursos importantes para editar sua categoria, vou falar sobre eles agora, clique em próximo.">
                <div class="btn-group">
                	<?php
					echo $this->Html->link(
						'<i class="icon-cogs"></i> Configurar',
						array('controller'=>'Categorias','action'=>'edita','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn ttip ','title'=>'Configurar '.$value['Categoria']['title'],'data-step'=>'8','data-intro'=>'Em Configurar você pode editar informações de SEO, visibilidade e títulos da categoria em questão.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-up"></i> Sobe',
						array('controller'=>'Categorias','action'=>'sobe','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover '.$value['Categoria']['title'].' para cima','data-step'=>'9',
						'data-intro'=>'Reorganiza o menu, movendo esta categoria para cima.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-down"></i> Desce',
						array('controller'=>'Categorias','action'=>'desce','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover  '.$value['Categoria']['title'].' para baixo',
						'data-step'=>'10',
						'data-intro'=>'Reorganiza o menu, movendo esta categoria para baixo.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i> Remover',
						array('controller'=>'Categorias','action'=>'remove','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn btn-danger ttip confirm','title'=>'Apagar  '.$value['Categoria']['title'].' definitivamente!','data-step'=>'11',
						'data-intro'=>'Apaga a categoria definitivamente.')
					);?>
                    </div>
                </td>
            </tr>
        <?php }else{ ?>
        	<tr>
            	<td><?php echo $i;?></td>
                <td><?php echo $value['Categoria']['titulo'];?></td>
                <td>
                <div class="btn-group">
                	<?php
					echo $this->Html->link(
						'<i class="icon-cogs"></i> Configurar',
						array('controller'=>'Categorias','action'=>'edita','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn ttip ','title'=>'Configurar '.$value['Categoria']['title'])
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-up"></i> Sobe',
						array('controller'=>'Categorias','action'=>'sobe','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover '.$value['Categoria']['title'].' para cima')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-down"></i> Desce',
						array('controller'=>'Categorias','action'=>'desce','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover  '.$value['Categoria']['title'].' para baixo')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i> Remover',
						array('controller'=>'Categorias','action'=>'remove','model'=>$categoria_pai,$value['Categoria']['id']),
						array('escape'=>false,'class'=>'btn btn-danger ttip confirm','title'=>'Apagar  '.$value['Categoria']['title'].' definitivamente!')
					);?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
            	<th>#</th>
                <th>Titulo da categoria</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
</div>
<hr />
<div class="btn-group" data-step="3" data-intro="Aqui!!!">
<?php echo $this->Html->link('Nova categoria',array('model'=>$categoria_pai,'controller'=>'Categorias','action'=>'add'),array('class'=>'btn btn-info','title'=>'Criar nova categoria')) ;?>
<?php echo $this->Html->link('Gerenciar galerias',array('controller'=>'Galerias','action'=>'index'),array('class'=>'btn','title'=>'Voltar para galerias')) ;?>
</div>
