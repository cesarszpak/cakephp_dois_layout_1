<?php echo $this->Form->create('Usuario',array('class'=>'form-signin')); ?>
<legend>Recuperando senha</legend>
<?php echo $this->element('info',array('message'=>'Para recuperar o acesso ao painel de gerenciamento do seu site, por favor, digite seu email ou login de acesso logo abaixo!'));?>
<?php
echo $this->Session->flash();
echo $this->Form->input('username',array('label'=>'Usuário','class'=>'input-block-level','maxlength'=>'512'));
echo $this->Form->button('Entrar',array('type'=>'submit'));
echo $this->Form->end();