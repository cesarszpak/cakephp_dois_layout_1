<div class="row-fluid">
    <div class="span12">
    	<legend>Páginas</legend>
    </div>
</div>
<?php echo $this->Html->link('Nova página',array('controller'=>'Paginas','action'=>'add'),array('class'=>'btn btn-info ttip','title'=>'Criar nova página','data-step'=>'1','data-intro'=>'Neste botão você consegue incluir rapidamente uma nova página no seu site, você ainda tem um outro botão igual a esse no fim da página, clique em próximo para ver onde.')) ;?>
<hr />
<div class="pagina-controller">
<?php echo $this->Session->flash(); ?>
    <table class="table-ajax table table-striped table-hover table-bordered" data-step="3" data-intro="Nesta tabela você encontra a listagem de páginas disponíveis no seu site e organizadas da forma que vão aparecer no menu de navegação.">
        <thead>
            <tr>
            	<th>#</th>
                <th>Titulo do menu</th>
                <th>Titulo da página</th>
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
            	<td data-step="4" data-intro="Este número representa a ordem atual da página que você está vendo, apenas um guia pra facilitar a visualização."><?php echo $i;?></td>
                <td data-step="5" data-intro="Este é o texto mostrado no menu da primeira página caso a exibição dela esteja ativada (vem ativada por padrão), note que ele pode ser estilizado ou alterado para se adequar ao layout do seu site!."><?php echo $value['Pagina']['titulo'];?></td>
                <td data-step="6" data-intro="Aqui você encontra o título que será impresso na aba do navegador, ele virá junto ao nome do site e é uma informação importante para os sites de busca!"><?php echo $value['Pagina']['title'];?></td>
                <td class="table-acoes" data-step="7" data-intro="Você também tem acesso a 5 recursos importantes para editar sua página, vou falar sobre eles agora, clique em próximo.">
                <div class="btn-group">
                	<?php
					echo $this->Html->link(
						'<i class="icon-edit"></i> Editar inline',
						array('cms'=>true,'controller'=>'paginas','action'=>'edita',$value['Pagina']['slug']),
						array('target'=>'_blank','escape'=>false,'class'=>'btn btn-success ttip','title'=>'Alterar o conteúdo de '.$value['Pagina']['title'],'data-step'=>'8','data-intro'=>'Ao clicar neste link você irá para uma nova janela na qual poderá alterar o conteúdo desta página diretamente no seu site.')
					);?>
                	<?php
					echo $this->Html->link(
						'<i class="icon-cogs"></i> Editar',
						array('controller'=>'Paginas','action'=>'edita',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn ttip ','title'=>'Configurar '.$value['Pagina']['title'],'data-step'=>'9','data-intro'=>'Em Editar você pode alterar o conteúdo da página, além de editar informações de SEO, visibilidade e títulos da página em questão.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-up"></i> Sobe',
						array('controller'=>'Paginas','action'=>'sobe',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn ttip',
						'title'=>'Mover '.$value['Pagina']['title'].' para cima',
						'data-step'=>'10',
						'data-intro'=>'Reorganiza o menu, movendo esta página para cima.')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-down"></i> Desce',
						array('controller'=>'Paginas','action'=>'desce',$value['Pagina']['id']),
						array('escape'=>false,
						'class'=>'btn ttip','title'=>'Mover  '.$value['Pagina']['title'].' para baixo',
						'data-step'=>'11',
						'data-intro'=>'Reorganiza o menu, movendo esta página para baixo.'
						)
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i> Remover',
						array('controller'=>'Paginas','action'=>'remove',$value['Pagina']['id']),
						array('escape'=>false,
						'class'=>'btn btn-danger ttip confirm',
						'title'=>'Apagar  '.$value['Pagina']['title'].' definitivamente!',
						'data-step'=>'12',
						'data-intro'=>'Apaga a página definitivamente.'
						)
					);?>
                    </div>
                </td>
            </tr>
        <?php }else{?>
        	<tr>
            	<td><?php echo $i;?></td>
                <td><?php echo $value['Pagina']['titulo'];?></td>
                <td><?php echo $value['Pagina']['title'];?></td>
                <td class="table-acoes">
                    <div class="btn-group">
                	<?php
					echo $this->Html->link(
						'<i class="icon-edit"></i> Editar inline',
						array('cms'=>true,'controller'=>'paginas','action'=>'edita',$value['Pagina']['slug']),
						array('target'=>'_blank','escape'=>false,'class'=>'btn btn-success ttip','title'=>'Alterar o conteúdo de '.$value['Pagina']['title'])
					);?>
                	<?php
					echo $this->Html->link(
						'<i class="icon-cogs"></i> Editar',
						array('controller'=>'Paginas','action'=>'edita',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn ttip ','title'=>'Configurar '.$value['Pagina']['title'])
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-up"></i> Sobe',
						array('controller'=>'Paginas','action'=>'sobe',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn ttip',
						'title'=>'Mover '.$value['Pagina']['title'].' para cima')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-down"></i> Desce',
						array('controller'=>'Paginas','action'=>'desce',$value['Pagina']['id']),
						array('escape'=>false,
						'class'=>'btn ttip','title'=>'Mover  '.$value['Pagina']['title'].' para baixo')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i> Remover',
						array('controller'=>'Paginas','action'=>'remove',$value['Pagina']['id']),
						array('escape'=>false,
						'class'=>'btn btn-danger ttip confirm',
						'title'=>'Apagar  '.$value['Pagina']['title'].' definitivamente!',)
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
                <th>Titulo do menu</th>
                <th>Titulo da página</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
</div>
<hr />
<?php echo $this->Html->link('Nova página',array('controller'=>'Paginas','action'=>'add'),array('class'=>'btn btn-info ttip','title'=>'Criar nova página','data-step'=>'2','data-intro'=>'Aqui.')) ;?>