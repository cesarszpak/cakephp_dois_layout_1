<?php $this->Html->addCrumb($conteudo['title']); ?>
<?php echo $this->element('temas/breadcrumb');?>
<?php if($user) echo $this->Session->flash(); ?>
<div class="container cms-conteudo">
	<?php echo $conteudo['corpo'];?>
</div>