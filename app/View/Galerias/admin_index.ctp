<div class="row-fluid">
    <div class="span12">
    	<legend>Galerias</legend>
    </div>
</div>
<div class="btn-group">
<?php echo $this->Html->link('Nova galeria',array('controller'=>'Galerias','action'=>'add'),array('class'=>'btn btn-info ttip','title'=>'Criar nova galeria','data-step'=>'1','data-intro'=>'Neste botão você consegue incluir rapidamente uma nova galeria de fotos no seu site, você ainda tem um outro botão igual a esse no fim da página.')) ;?>
<?php echo $this->Html->link('Gerenciar categorias',array('controller'=>'Categorias','action'=>'index','Galeria'),array('class'=>'ttip btn','title'=>'Ir para lista de categorias','data-step'=>'2','data-intro'=>'Já este botão vai te levar direto para o gerenciamento de Categorias, existe outro botão como este no fim da página, clique em Próximo para saber aonde.')) ;?>
<?php //echo $this->Html->link('<i class="icon-cogs"></i> Configurações',array('controller'=>'Galerias','action'=>'configuracoes'),array('class'=>'ttip btn','title'=>'Opções de configuração da galeria','data-step'=>'3','data-intro'=>'Aqui você pode alterar configurações de exibição das galerias no seu site.','escape'=>false)) ;?>
</div>
<hr/>
<div class="pagina-controller">
<?php echo $this->Session->flash(); ?>
    <table class="table-ajax table table-striped table-hover table-bordered" data-step="5" data-intro="Nesta tabela você encontra a listagem de galerias disponíveis no seu site e organizadas da forma que vão aparecer.">
        <thead>
            <tr>
            	<th>#</th>
                <th>Titulo da galeria</th>
                <th>Categoria</th>
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
            	<td data-step="6" data-intro="Este número representa a ordem atual da galeria que você está vendo, apenas um guia pra facilitar a visualização."><?php echo $i;?></td>
                <td data-step="7" data-intro="Este é o nome da sua galeria, assim, além de saber aonde você está, ainda pode usar a caixa de pesquisa no canto superior direito para encontrar o que precisa!"><?php echo $value['Galeria']['titulo'];?></td>
                <td data-step="8" data-intro="Com as categorias fica fácil para você reorganizar esta listagem para agrupar categorias ou pesquisar galerias com a mesma categoria, filtrando os resultados."><?php if(isset($value['Categoria'][0])) echo $value['Categoria'][0]['titulo'];?></td>
                <td class="table-acoes" data-step="9" data-intro="Você também tem acesso a 5 recursos importantes para editar sua galeria, vou falar sobre eles agora, clique em próximo.">
                <div class="btn-group">
                	<?php
					echo $this->Html->link(
						'<i class="icon-picture"></i> Gerenciar imagens',
						array('controller'=>'Imagens','action'=>'index',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn btn-success ttip','title'=>'Alterar o conteúdo de '.$value['Galeria']['titulo'],'data-step'=>'10','data-intro'=>'Ao clicar neste link você irá para a página de gerenciamento de imagens desta galeria, é possível editar informações, inserir novas imagens, apagar ou reordenar a exibição.')
					);?>
                	<?php
					echo $this->Html->link(
						'<i class="icon-cogs"></i> Configurar',
						array('controller'=>'Galerias','action'=>'edita',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn ttip ','title'=>'Configurar '.$value['Galeria']['titulo'],'data-step'=>'11','data-intro'=>'Em Configurar você pode editar informações de SEO, visibilidade e títulos da galeria em questão.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-up"></i> Sobe',
						array('controller'=>'Galerias','action'=>'sobe',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover '.$value['Galeria']['titulo'].' para cima',
						'data-step'=>'12',
						'data-intro'=>'Reorganiza o menu, movendo esta galeria para cima.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-down"></i> Desce',
						array('controller'=>'Galerias','action'=>'desce',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover  '.$value['Galeria']['titulo'].' para baixo',
						'data-step'=>'13',
						'data-intro'=>'Reorganiza o menu, movendo esta galeria para baixo.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i> Remover',
						array('controller'=>'Galerias','action'=>'remove',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn btn-danger ttip confirm','title'=>'Apagar  '.$value['Galeria']['titulo'].' definitivamente!','data-step'=>'14',
						'data-intro'=>'Apaga a galeria definitivamente.')
					);?>
                    </div>
                </td>
            </tr>
            <?php }else{?>
            <tr>
            	<td><?php echo $i;?></td>
                <td><?php echo $value['Galeria']['titulo'];?></td>
                <td><?php if(isset($value['Categoria'][0])) echo $value['Categoria'][0]['titulo'];?></td>
                <td class="table-acoes">
                <div class="btn-group">
                	<?php
					echo $this->Html->link(
						'<i class="icon-picture"></i> Gerenciar imagens',
						array('controller'=>'Imagens','action'=>'index',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn btn-success ttip','title'=>'Alterar o conteúdo de '.$value['Galeria']['titulo'])
					);?>
                	<?php
					echo $this->Html->link(
						'<i class="icon-cogs"></i> Configurar',
						array('controller'=>'Galerias','action'=>'edita',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn ttip ','title'=>'Configurar '.$value['Galeria']['titulo'])
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-up"></i> Sobe',
						array('controller'=>'Galerias','action'=>'sobe',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover '.$value['Galeria']['titulo'].' para cima')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-down"></i> Desce',
						array('controller'=>'Galerias','action'=>'desce',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn ttip','title'=>'Mover  '.$value['Galeria']['titulo'].' para baixo')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i> Remover',
						array('controller'=>'Galerias','action'=>'remove',$value['Galeria']['id']),
						array('escape'=>false,'class'=>'btn btn-danger ttip confirm','title'=>'Apagar  '.$value['Galeria']['titulo'].' definitivamente!')
					);?>
                    </div>
                </td>
            </tr>
            <?php }?>
        <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
            	<th>#</th>
                <th>Titulo da galeria</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
</div>
<hr />
<div class="btn-group" data-step="4" data-intro="Aqui!!!">
<?php echo $this->Html->link('Nova galeria',array('controller'=>'Galerias','action'=>'add'),array('class'=>'btn btn-info ttip','title'=>'Criar nova galeria')) ;?>
<?php echo $this->Html->link('Gerenciar categorias',array('controller'=>'Categorias','action'=>'index','Galeria'),array('class'=>'ttip btn','title'=>'Ir para lista de categorias')) ;?>
<?php //echo $this->Html->link('<i class="icon-cogs"></i> Configurações',array('controller'=>'Galerias','action'=>'configuracoes'),array('class'=>'ttip btn','title'=>'Opções de configuração da galeria','escape'=>false)) ;?>
</div>