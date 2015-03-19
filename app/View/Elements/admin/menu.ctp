<?php if($user){?>
<nav id="menu-principal" class="container-fluid">
	<ul class="nav nav-tabs">
                <?php if($permissoes['Painel']['permissao']){?><li<?php if($active=='home') echo ' class="active"';?>><?php echo $this->Html->link('Home','/admin/');?></li><?php };?>
		<?php if($permissoes['Paginas']['permissao']){?><li<?php if($active=='paginas') echo ' class="active"';?>><?php echo $this->Html->link('Páginas','/admin/Paginas/index');?></li><?php };?>
                <?php if($permissoes['Galerias']['permissao']){?><li<?php if($active=='galerias') echo ' class="active"';?>><?php echo $this->Html->link('Galeria','/admin/Galerias/index');?></li><?php };?>
	</ul>
</nav>
<?php };?>