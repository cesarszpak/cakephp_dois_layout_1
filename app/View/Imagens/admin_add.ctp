<div class="row-fluid">
    <div class="span12">
    	<legend>Imagens</legend>
    </div>
</div>
<?php echo $this->Html->script(array('imgadmin/admin.js'),array('inline'=>false));?>
<?php echo $this->Session->flash(); ?>
<?php
	echo $this->Form->create('Imagem',array('class'=>'form-horizontal'));
	?>
    <legend>Inserindo imagem</legend>
    <?php
	echo $this->Form->input('titulo');
	echo $this->Form->input('url',array('class'=>'img-select'));
	echo $this->Form->input('Galeria.id',array('value'=>$galeria_id));
	?>
    <div class="btn-group">
		<?php
            echo $this->Form->button('Criar',array('class'=>'btn btn-primary'));
            echo $this->Html->link(
				'Cancelar',
				array(
					'action'=>'index',
						$galeria_id
				),
				array('class'=>'btn'));
        ?>
    </div>
	<?php
	echo $this->Form->end();