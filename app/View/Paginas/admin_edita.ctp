<div class="row-fluid">
    <div class="span12">
    	<legend>Páginas</legend>
    </div>
</div>
<?php echo $this->Session->flash(); ?>
<?php
	echo $this->Form->create('Pagina',array('class'=>'form-horizontal'));
?>
<div class="row-fluid">
    <div class="span12">
    	<legend>Editando página</legend>
    </div>
</div>
<div class="row-fluid">
	<div class="span6">
        <h4>Menu</h4>
        <?php
            echo $this->Form->input('titulo',array('label'=>'Título do menu'));
			echo $this->Form->input('controller',array('label'=>'Tipo','options'=>Configure::read('Controllers'),'empty'=>'Página simples'));
        ?>
        <hr />
        <h4>Visibilidade</h4>
        <?php
            echo $this->Form->input('menu',array('label'=>'Mostrar no menu?','options'=>array('Não','Sim')));
            echo $this->Form->input('habilitar',array('label'=>'Página ativada?','options'=>array('Não','Sim')));
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
		<p>
			<?php
				echo $this->Form->input('corpo',array('label'=>false,'class'=>'ckeditor','div'=>false));
			?>
		</p>
		<p><div class="alert alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Este editor não é compatível com a Edição inline!</h4>
			<p>Não faça inclusão de novas linhas aqui caso queira usar o Editor inline!</p>
		</div></p>
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
echo $this->Html->script(array(  
    '/imgadmin/js/ckeditor/ckeditor.js'  
),array('inline'=>false)); 
?>