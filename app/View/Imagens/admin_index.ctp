<div class="row-fluid">
    <div class="span12">
    	<legend>Imagens</legend>
    </div>
</div>
<div class="btn-group">
<?php echo $this->Html->link('Nova imagem',array('controller'=>'Imagens','action'=>'add',$retorno[0]['Galeria']['id']),array('class'=>'btn btn-info','title'=>'Criar nova imagem')) ;?>
<?php echo $this->Html->link('Gerenciar galerias',array('controller'=>'Galerias','action'=>'index'),array('class'=>'btn','title'=>'Voltar para galerias')) ;?>
</div>
<hr />
<div class="pagina-controller">
<?php echo $this->Session->flash(); ?>
    <ul class="thumbnails">
        <?php
			foreach($retorno[0]['Imagem'] as $value):
		?>
            <li class="span3">
            	<div class="thumbnail text-center">
                	<?php echo $this->Html->image('upload/medio/'.$value['url']);?>
                    <h4><?php echo $value['titulo'];?></h4>
					<?php
                    echo $this->Html->link(
                        '<i class="icon-cogs"></i> Configurar',
                        array('controller'=>'Imagens','action'=>'edita',$value['id']),
                        array('escape'=>false,'class'=>'btn ttip ','title'=>'Configurar '.$value['titulo'])
                    );?><br />
                    <div class="btn-group">
                        <?php
                        echo $this->Html->link(
                            '<i class="icon-sort-up"></i> Sobe',
                            array('controller'=>'Imagens','action'=>'sobe',$value['id']),
                            array('escape'=>false,'class'=>'btn ttip','title'=>'Mover '.$value['titulo'].' para cima')
                        );?>
                        <?php
                        echo $this->Html->link(
                            '<i class="icon-sort-down"></i> Desce',
                            array('controller'=>'Imagens','action'=>'desce',$value['id']),
                            array('escape'=>false,'class'=>'btn ttip','title'=>'Mover  '.$value['titulo'].' para baixo')
                        );?>
                    </div><br />
                    <?php
                    echo $this->Html->link(
                        '<i class="icon-remove"></i> Remover',
                        array('controller'=>'Imagens','action'=>'remove',$value['id']),
                        array('escape'=>false,'class'=>'btn btn-danger ttip confirm','title'=>'Apagar  '.$value['titulo'].' definitivamente!')
                    );?>
            	</div>
        	</li>
        <?php endforeach;?>
        </ul>
</div>
<hr />
<div class="btn-group">
<?php echo $this->Html->link('Nova imagem',array('controller'=>'Imagens','action'=>'add',$retorno[0]['Galeria']['id']),array('class'=>'btn btn-info','title'=>'Criar nova imagem')) ;?>
<?php echo $this->Html->link('Gerenciar galerias',array('controller'=>'Galerias','action'=>'index'),array('class'=>'btn','title'=>'Voltar para galerias')) ;?>
</div>
