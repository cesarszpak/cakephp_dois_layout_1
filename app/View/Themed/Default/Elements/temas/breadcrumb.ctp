<section class="container breadcrumbs">
    <div class="row">
        <div class="span9 hidden-phone">
            <p>Você está em: <strong><?php echo $this->Html->getCrumbs(' > ', $configs['title']);?></strong></p>
        </div>
        <div class="span3 text-right">
			<?php
			echo $this->Html->link(
				$this->Html->image('icon-facebook.png'),
				'http://www.facebook.com.br',
				array(
					'escape'=>false,
					'rel'=>'social',
					'class'=>'no-ajax',
			));
			echo $this->Html->link(
                $this->Html->image('icon-email.png'),
				'/contato',
				array(
					'escape'=>false
			));?>
        </div>
    </div>
</section>
