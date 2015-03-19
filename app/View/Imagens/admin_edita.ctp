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
<div class="row-fluid">
    <div class="span12">
    	<legend>Editando imagem</legend>
    </div>
</div>
<div class="row-fluid">
	<div class="span6">
        <?php
            echo $this->Form->input('titulo');
        ?>
        <?php
            echo $this->Form->input('descricao',array('type'=>'textarea'));
        ?>
        <?php
            echo $this->Form->input('url',array('class'=>'img-select'));
        ?>
        <hr />
        <h4>Visibilidade</h4>
        <?php
            echo $this->Form->input('habilitar',array('label'=>'Categoria ativada?','options'=>array('Não','Sim')));
        ?>
    </div>
    <div class="span6"><?php echo $this->Html->image('upload/medio/'.$this->data['Imagem']['url']);?></div>
</div>
<div class="row-fluid">
    <div class="span12">
    	<div class="btn-group">
            <?php
                echo $this->Form->button('Salvar',array('class'=>'btn btn-primary'));
                echo $this->Html->link(
                    'Cancelar',
                    array(
                        'action'=>'index',
						$this->data['Galeria'][0]['id']
                    ),
                    array('class'=>'btn'));
            ?>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();
?>
