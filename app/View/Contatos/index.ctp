<?php $this->Html->addCrumb('Contato'); ?>
<div class="container">
    <div class="row">
    	<?php $flash=$this->Session->flash(); if($flash):?><div class="span12">
			<?php echo $flash; ?>
        </div><?php endif;?>
    </div>
    <div class="row">
    	<div class="span6">
        	<legend>Contato</legend>
        	<address>
				<?php if(!empty($configs['nomecontato'])):?><strong><?php echo $configs['nomecontato'];?></strong><br><?php endif; ?>
                <?php if(!empty($configs['email'])):?><abbr title="E-mail">Email:</abbr> <?php echo $configs['email'];?><br><?php endif; ?>
                <?php if(!empty($configs['endereco'])):?><abbr title="Endereço">End:</abbr> <?php echo $configs['endereco'];?><br><?php endif; ?>
                <?php if(!empty($configs['fone'])):?><abbr title="Telefone">Fone:</abbr> <?php echo $configs['fone'];?><br><?php endif; ?>
                <?php if(!empty($configs['cel'])):?><abbr title="Celular">Cel:</abbr> <?php echo $configs['cel'];?><?php endif; ?>
        </address>
            <div class="cms-conteudo">
            	<?php echo $conteudo['corpo'];?>
            </div>
        </div>
        <div class="span6">
			<?php
            //debug($configs);
            echo $this->Form->create('Contato',array('class'=>'form-horizontal'));
			?>
            	<legend>Envie um email para nós</legend>
            <?php
            echo $this->Form->input('nome',array('placeholder'=>'Seu nome...','class'=>'input-block-level'));
            echo $this->Form->input('telefone',array('placeholder'=>'(12)9999-9999','class'=>'input-block-level'));
            echo $this->Form->input('email',array('placeholder'=>'Seu email...','type'=>'email','class'=>'input-block-level'));
            echo $this->Form->input('mensagem',array('type'=>'textarea','placeholder'=>'A mensagem completa...','class'=>'input-block-level'));
            echo $this->Form->input('emailPara',array('type'=>'hidden','value'=>$configs['email']));
			echo $this->Form->input('enviar',array('class'=>'btn btn-success','type'=>'button','label'=>''));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>