<div class="row-fluid">
    <div class="span12">
    	<legend>Categorias</legend>
    </div>
</div>
<?php echo $this->Session->flash(); ?>
<?php
	echo $this->Form->create('Categoria',array('class'=>'form-horizontal'));
	?>
    <legend>Criando categoria</legend>
    <?php
	echo $this->Form->input('titulo',array('data-step'=>'1','data-intro'=>'Aqui você pode define o título da sua categoria, ele vai gerar altomáticamente o link e também o título \'title\' (que aparece no topo do navegador e nas buscas), você pode alterar essas e outras informações em "Configurar" após esta categoria ser criada. Escreva o título e clique em Próximo.'));
	?>
    <div class="btn-group">
		<?php
            echo $this->Form->button('Criar',array('class'=>'btn btn-primary','data-step'=>'3','data-intro'=>'Quando terminar você poderá alterar parametros importantes de SEO, visibilidade e titulos com o botão \'Configurar\', apagar com o botão \'Remover\' ou alterar a posição no menu com os botões \'Sobe\' e \'Desce\'. Clique para criar sua categoria.'));
            echo $this->Html->link(
				'Cancelar',
				array(
					'action'=>'index','model'=>$categoria_pai
				),
				array('class'=>'btn','data-step'=>'2','data-intro'=>'Clique aqui para desistir ou em próximo para continuar.'));
        ?>
    </div>
	<?php
	echo $this->Form->end();