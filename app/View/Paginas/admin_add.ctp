<div class="row-fluid">
    <div class="span12">
    	<legend>Páginas</legend>
    </div>
</div>
<?php echo $this->Session->flash(); ?>
<?php
	echo $this->Form->create('Pagina',array('class'=>'form-horizontal'));
	?>
    <legend>Criando página</legend>
    <?php
	echo $this->Form->input('titulo',array('data-step'=>'1','data-intro'=>'Aqui você pode preencher o título que vai aparecer no menu, ele vai gerar altomáticamente o link e também o título da página (que aparece no topo do navegador e nas buscas), você pode alterar essas e outras informações em "Configurar" após esta página ser criada. Escreva o título e clique em Próximo.'));
	echo $this->Form->input('controller',array('label'=>'Tipo','options'=>Configure::read('Controllers'),'empty'=>'Página simples','data-step'=>'2','data-intro'=>'Escolha agora o tipo da página em questão, como por exemplo Página simples, para uma página de texto e imagens, Página de contato para exibir informações de contato e um formulário de email (você pode editar estas informações nas configurações do site) ou Galerias de Imagens para exibir suas fotos. Outros recursos podem estar disponíveis dependendo do seu painel de gerenciamento.'));
	?>
     <div class="alert alert-block alert-info">Após clicar em criar, escolha a opção <strong>Editar conteúdo</strong> para inserir conteúdo na página!</div>
    <div class="btn-group">
		<?php
            echo $this->Form->button('Criar',array('class'=>'btn btn-primary','data-step'=>'4','data-intro'=>'Quando terminar você poderá formatar e inserir conteúdos com o botão \'Editar Conteúdo\', Alterar parametros importantes de SEO, visibilidade e menu com o botão \'Configurar\', apagar com o botão \'Remover\' ou alterar a posição no menu com os botões \'Sobe\' e \'Desce\'. Clique para criar sua página.'));
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