<!DOCTYPE html>
<html>
  <head>
  
    <?php echo $this->element('temas/head');?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <?php 
		echo $this->Html->css(
			array(
				'bootstrap',
				'bootstrap-extend',
				'/fancy/jquery.fancybox',
				'style',
			)
		);
	?>
	
  </head>
  <body data-stellar-background-ratio="0.2" class="<?php echo $this->element('temas/bodyclass')?>">
  
  <header id="header">
	<section class="container p-relative">
    	<div class="row">
        	<div class="span5 mobile-center" data-stellar-ratio="0.2">
            	<?php echo $this->element('temas/logotipo');?>
            </div>
            <div class="span7 p-relative mobile-center sozinho">
            	<nav class="menu-desktop hidden-phone hidden-tablet" data-stellar-ratio="0.5">
            		<?php echo $this->element('temas/menu');?>
                </nav>
                <nav class="dropdown hidden-desktop text-center">
                	<?php echo $this->element('temas/menu');?>
                </nav>
            </div>
        </div>
        <section class="legenda-principal text-left hidden-phone mobile-center" data-stellar-ratio="1.2">
            <h3 class="text-center"><?php echo $configs['tagline'];?></h3>
        </section>
    </section>
</header>
<main>
	<article id="conteudo">
    	<div class="conteudo">
            <?php echo $this->fetch('content'); ?>
        </div>
    </article>
</main>
<footer id="footer" class="text-center">
	<section class="container">
    	<div class="row">
        	<div class="span12">
            	<nav class="text-center">
                    <?php echo $this->element('temas/menu');?>
                </nav>
            </div>
            </div>
        </div>
    </section>
	<p><small><strong>Todos os direitos reservados!</strong></small></p>
</footer>
    <?php
	echo $this->Html->script(array(
		'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
		'bootstrap.min',
		'jquery.stellar.min',
		'jquery.easing',
		'jquery.history',
		'/fancy/jquery.fancybox',
	));

	echo $this->Html->scriptBlock(
		'base_url="'.$this->webroot.'";'
	);
	echo $this->Html->script(array(
		'parallax-ajax',
	));
	
	echo $this->element('temas/footer');
	?>
  </body>
</html>