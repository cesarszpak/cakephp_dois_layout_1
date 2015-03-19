<address>
	<?php if(!empty($configs['nomecontato'])):?><strong><?php echo $configs['nomecontato'];?></strong><br><?php endif; ?>
	<?php if(!empty($configs['email'])):?><abbr title="E-mail">Email:</abbr> <?php echo $configs['email'];?><br><?php endif; ?>
	<?php if(!empty($configs['endereco'])):?><abbr title="Endereço">End:</abbr> <?php echo $configs['endereco'];?><br><?php endif; ?>
	<?php if(!empty($configs['fone'])):?><abbr title="Telefone">Fone:</abbr> <?php echo $configs['fone'];?><br><?php endif; ?>
	<?php if(!empty($configs['cel'])):?><abbr title="Celular">Cel:</abbr> <?php echo $configs['cel'];?><?php endif; ?>
</address>