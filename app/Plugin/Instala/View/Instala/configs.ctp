<div class="container">
<div class="row">
<div class="span12">
<?php
echo $this->Form->create('Configuracao');
?>
<legend>Dados do site</legend>
<?php
echo $this->Form->input('titulo');
echo $this->Form->input('tagline');
?>
<legend>Dados de contato</legend>
<?php
echo $this->Form->input('nomecontato',array('label'=>'Nome do contato'));
echo $this->Form->input('email');
echo $this->Form->input('fone',array('label'=>'Telefone'));
echo $this->Form->input('cel',array('label'=>'Celular'));
echo $this->Form->input('endereco',array('label'=>'Endereços'));
echo $this->Form->input('Finalizar',array('type'=>'submit','label'=>false,'class'=>'btn btn-success btn-big'));
echo $this->Form->end();
?>
</div>
</div>
</div>