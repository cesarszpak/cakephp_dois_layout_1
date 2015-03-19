<div class="pagina-controller">
<?php echo $this->Session->flash(); ?>
    <table class="table-ajax table table-striped table-hover table-bordered">
        <thead>
            <tr>
            	<th>&nbsp;</th>
                <th>Titulo do menu</th>
                <th>Titulo da página</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($retorno as $value):?>
            <tr>
            	<td>&nbsp;</td>
                <td><?php echo $value['Pagina']['titulo'];?></td>
                <td><?php echo $value['Pagina']['title'];?></td>
                <td class="table-acoes">
                	<?php
					echo $this->Html->link(
						'<i class="icon-edit"></i>',
						array('controller'=>'Paginas','action'=>'edita',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn plugin','title'=>'Editando '.$value['Pagina']['title'])
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-up"></i>',
						array('controller'=>'Paginas','action'=>'sobe',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn plugin')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-sort-down"></i>',
						array('controller'=>'Paginas','action'=>'desce',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn plugin')
					);?>
                    <?php
					echo $this->Html->link(
						'<i class="icon-remove"></i>',
						array('controller'=>'Paginas','action'=>'remove',$value['Pagina']['id']),
						array('escape'=>false,'class'=>'btn plugin confirm')
					);?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
            	<td>&nbsp;</td>
                <th>Titulo do menu</th>
                <th>Titulo da página</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
</div>
<hr />
<?php echo $this->Html->link('Nova página',array('ajax'=>true,'controller'=>'Paginas','action'=>'add'),array('class'=>'btn btn-info','title'=>'Criando nova página')) ;?>