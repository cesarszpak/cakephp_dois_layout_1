<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Composite CMS - Instalador
	</title>
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap','font-awesome'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
    <header id="header">
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner container-fluid">
                <?php echo $this->Html->link('Composite CMS','/admin',array('class'=>'brand'));?>
            </div>
        </div>
        
    </header>
        
    <div id="content" class="container-fluid">
    
        <?php if($user) echo $this->Session->flash(); ?>

        <?php echo $this->fetch('content'); ?>
    </div>
</body>
</html>
