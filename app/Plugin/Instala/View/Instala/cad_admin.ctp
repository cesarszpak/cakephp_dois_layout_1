<div class="container">
<div class="row">
<div class="span12">
<?php
echo $this->Form->create('Usuario');
?>
<legend>Cadastre o usuário administrador do painel</legend>
<?php
echo $this->Form->input('nome');
echo $this->Form->input('sobrenome');
echo $this->Form->input('email');
echo $this->Form->input('username',array('label'=>'Usuário'));
echo $this->Form->input('password',array('label'=>'Senha'));
echo $this->Form->input('confirma',array('label'=>'Confirmação de senha','type'=>'password'));
echo $this->Form->input('Prosseguir com a instalação',array('type'=>'submit','label'=>false,'class'=>'btn btn-success btn-big'));
echo $this->Form->end();
?>
</div>
</div>
</div>