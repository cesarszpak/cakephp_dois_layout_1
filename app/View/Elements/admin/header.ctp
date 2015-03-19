<?php if($user){?>
<nav>
    <ul class="nav">
        <li>
            <?php echo $this->Html->link(
			'<b class="icon-user"></b> Meu perfil - Bem vindo '.$user['nome'] . ' ' . $user['sobrenome'],
			array('admin'=>true,'controller'=>'Usuarios','action'=>'add',$user['id']),
			array('escape'=>false));?></li>
        </li>
        <li>
            <?php echo $this->Html->link(
			'<b class="icon-arrow-left"></b> Ir para o site',
			'/',
			array('escape'=>false,'target'=>'_blank'));?></li>
        </li>
		<?php if($permissoes['Usuarios']['permissao']){?><li>
            <?php echo $this->Html->link(
			'<b class="icon-cog"></b> Usuários',
			array('admin'=>true,'controller'=>'Usuarios','action'=>'index'),
			array('escape'=>false));?></li>
        </li><?php };?>
        <?php if($permissoes['Configuracoes']['permissao']){?><li>
            <?php echo $this->Html->link(
			'<b class="icon-cog"></b> Configurações',
			array('admin'=>true,'controller'=>'Configuracoes','action'=>'index'),
			array('escape'=>false));?></li>
        </li><?php };?>
    </ul>
</nav>
<nav>
    <ul class="nav pull-right">
    	<li>
        <a href="javascript:void(0);" onclick="javascript:introJs().start();" id="btn-ajuda">
        	Ajuda <b class="icon-question-sign"></b>
        </a>
        </li>
        <li>
		<?php echo $this->Html->link(
			'Sair <b class="icon-off"></b>',
			array('admin'=>true,'controller'=>'Usuarios','action'=>'logout'),
			array('escape'=>false));?></li>
    </ul>
</nav>
<?php };?>