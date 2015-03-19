<div class="row-fluid">
    <div class="span12">
    	<legend>Galerias</legend>
    </div>
</div>
<?php echo $this->Session->flash(); ?>
<?php
	echo $this->Form->create('Galeria',array('class'=>'form-horizontal'));
	?>
    <legend>Criando galeria</legend>
    <?php
	echo $this->Form->input('titulo',array('data-step'=>'1','data-intro'=>'Aqui você pode define o título da sua galeria, ele vai gerar altomáticamente o link e também o título \'title\' (que aparece no topo do navegador e nas buscas), você pode alterar essas e outras informações em "Configurar" após esta galeria ser criada. Escreva o título e clique em Próximo.'));
	echo $this->Form->input('Categoria.0.id',array('options'=>$categorias,'empty'=>'(Nenhuma)','data-step'=>'2','data-intro'=>'Escolha agora a categoria a qual esta galeria vai pertencer, escolhendo \'Nenhum\' você coloca ela direto na página inicial.','label'=>'Categoria'));
	?>
     <div class="alert alert-block alert-info">Após clicar em criar, escolha a opção <strong>Gerenciar Imagens</strong> para inserir imagens na galeria!</div>
    <div class="btn-group">
		<?php
            echo $this->Form->button('Criar',array('class'=>'btn btn-primary','data-step'=>'4','data-intro'=>'Quando terminar você poderá inserir imagens na galeria com o botão \'Gerenciar imagens\', Alterar parametros importantes de SEO, visibilidade e titulos com o botão \'Configurar\', apagar com o botão \'Remover\' ou alterar a posição no menu com os botões \'Sobe\' e \'Desce\'. Clique para criar sua galeria.'));
            echo $this->Html->link(
				'Cancelar',
				array(
					'action'=>'index'
				),
				array('class'=>'btn','data-step'=>'3','data-intro'=>'Clique aqui para desistir ou em próximo para continuar.'));
        ?>
    </div>
	<?php
	echo $this->Form->end();