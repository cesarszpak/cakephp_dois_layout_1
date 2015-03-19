<div class="row-fluid">
    <div class="span12">
    	<legend>Galerias</legend>
    </div>
</div>
<?php echo $this->Session->flash(); ?>
<?php
	echo $this->Form->create('Galeria',array('class'=>'form-horizontal'));
?>
<div class="row-fluid">
    <div class="span12">
    	<legend>Editando galeria</legend>
    </div>
</div>
<div class="row-fluid">
	<div class="span6">
        <h4>Menu</h4>
        <?php
            echo $this->Form->input('titulo',array('label'=>'Título do menu'));
			echo $this->Form->input('Categoria',array('options'=>$categorias,'empty'=>'(Nenhuma)','multiple'=>false));
        ?>
        <hr />
        <h4>Visibilidade</h4>
        <?php
            echo $this->Form->input('habilitar',array('label'=>'Galeria ativada?','options'=>array('Não','Sim')));
        ?>
    </div>
    <div class="span6">
        <h4>SEO (Otimização para motores de busca)</h4>
        <?php
            echo $this->Form->input('title',array('label'=>'Tag title'));
            echo $this->Form->input('descricao',array('label'=>'Meta tag de descrição'));
            echo $this->Form->input('tags',array('label'=>'Palavras chave'));
            echo $this->Form->input('slug',array('label'=>'URL Amigável'));
        ?>
        <hr />
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
    	<div class="btn-group">
            <?php
                echo $this->Form->button('Salvar',array('class'=>'btn btn-primary'));
                echo $this->Html->link(
                    'Cancelar',
                    array(
                        'action'=>'index'
                    ),
                    array('class'=>'btn'));
            ?>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();
?>
