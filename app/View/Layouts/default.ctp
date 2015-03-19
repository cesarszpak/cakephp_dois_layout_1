<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Composite CMS
	</title>
    <meta http-equiv="content-language" content=”pt-br”>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap','font-awesome','dataTables','admin-tema','introjs.min'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
<div id="wrap">
    <header id="header">
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner container-fluid">
                <?php echo $this->Html->link('Composite CMS','/admin',array('class'=>'brand'));?>
                <?php echo $this->element('admin/header');?> 
            </div>
        </div>
        
            <?php echo $this->element('admin/menu');?>
        
    </header>
        
    <div id="content" class="container-fluid">
    
        <?php if($user) echo $this->Session->flash(); ?>

        <?php echo $this->fetch('content'); ?>
    </div>
</div>
    <footer id="footer" class="navbar">
        <div class="navbar-inner container-fluid">
            <?php echo $this->Html->link('Composite CMS','http://cms.erikfigueiredo.com.br/',array('target' => '_blank', 'class'=>'brand text-center'));?>
        </div>
    </footer>
<?php if($user) :?>
<div id="alert-login-ajuda" class="text-center">
	<p>
		<?php echo $this->Html->image('arrow-up.png');?><br/>
        Clique aqui se precisar de ajuda!
    </p>
</div>
<?php endif;?>
    <?php echo $this->Html->script(array('jquery.min','bootstrap','dataTables','admin-tema','intro.min'));?>
    <script type="text/javascript">
		base_url='<?php echo $this->Html->url('/');?>';
	</script>
    <?php echo $this->fetch('script'); ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
