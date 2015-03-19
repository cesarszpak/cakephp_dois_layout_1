<div id="painel" class="container-fluid">
	<div class="row-fluid">
    	<div class="span12">
        	<div class="hero-unit">
        		<h1>Olá <?php echo $user['nome'];?>,</h1>
                <h3>Bem vindo ao painel do seu site.</h3>
                <p>Para iniciar escolha um item no menu acima, nos atalhos abaixo, ou clique no icone de ajuda no canto superior direito.</p>
                <p><small>Att. <a href="http://www.erikfigueiredo.com.br/" target="_blank">Erik Figueiredo.</a></small></p>
                <div data-step="6" data-intro="Para começar, escolha uma opção!">
                <p class="text-center" data-step="1" data-intro="Este é o menu de acesso as seções da administração, você também pode acessar uma versão no topo de todas as páginas da administração!">
                <?php 
                        if($permissoes['Paginas']['permissao']){
                                echo $this->Html->link(
					$this->Html->image('btn-paginas.png').'<br/>Gerenciar páginas',
					array('admin'=>true,'controller'=>'Paginas','action'=>'index'),
					array('class'=>'btn','escape'=>false,'data-step'=>'2','data-intro'=>'Aqui você altera as páginas e o menu do seu site, como opções avançadas de SEO e opções de visibilidade.'));
                        }
                                ?>
				<?php 
                                    if($permissoes['Galerias']['permissao']){
                                        echo $this->Html->link(
					$this->Html->image('btn-galeria.png').'<br/>Gerenciar galerias',
					array('admin'=>true,'controller'=>'Galerias','action'=>'index'),
					array('class'=>'btn','escape'=>false,'data-step'=>'3','data-intro'=>'Gerenciamento de categorias, galerias e imagens da seção de imagens do seu site.'));
                                    }
				?>
				<?php 
                                    if($permissoes['Usuarios']['permissao']){
                                        echo $this->Html->link(
					$this->Html->image('btn-usuarios.png').'<br/>Gerenciar usuários',
					array('admin'=>true,'controller'=>'Usuarios','action'=>'index'),
					array('class'=>'btn','escape'=>false,'data-step'=>'4','data-intro'=>'Inclui, remove e edita pessoas que terão acesso as informações da administração.'));
                                    }
				?>
				<?php 
                                    if($permissoes['Configuracoes']['permissao']){
                                        echo $this->Html->link(
					$this->Html->image('btn-configuracao.png').'<br/>Configurações do site',
					array('admin'=>true,'controller'=>'Configuracoes','action'=>'index'),
					array('class'=>'btn','escape'=>false,'data-step'=>'5','data-intro'=>'Configura as informações básicas do site como o nome, base do SEO e informações de contato do site.'));
                                    }
				?>
                </p>
                </div>
            </div>
        </div>
    </div>
</div>