<div data-step="1" data-intro="Aqui você pode editar ou criar um usuário novo usuário, bastando confirmar clicando em Salvar no rodapé do formulário, os campos serão validados e uma mensagem será mostrada caso algo não esteja de acordo.">
<?php echo $this->Form->create('Usuario',array('class'=>'form-horizontal')); ?>
<legend>Adicionando novo usuário</legend>
<?php
echo $this->Session->flash();
echo $this->Form->input('nome',array('data-step'=>'2','data-intro'=>'Aqui você escreve seu nome, mas só o primeiro é necessário.'));
echo $this->Form->input('sobrenome',array('data-step'=>'3','data-intro'=>'E aqui seu sobrenome, se quiser completar com o nome completo, também é válido (menos o primeiro nome)'));
echo $this->Form->input('username',array('label'=>'Usuário','data-step'=>'4','data-intro'=>'Escolha um nome para acessar a adminsitração, por questão de segurança o ideal seria ele ser diferente do seu nome, mas isso não é regra. Também deve ser único, ou seja, não pode existir nenhuma outra pessoa usando um usuário igual.'));
echo $this->Form->input('email',array('data-step'=>'5','data-intro'=>'Seu email, ele também pode ser usado no lugar do usuário.'));
echo $this->Form->input('grupo',array('data-step'=>'6','data-intro'=>'O grupo de permissões dete usuário.','options'=>$grupos));
echo $this->Form->input('password',array('required'=>false,'label'=>'Senha','data-step'=>'7','data-intro'=>'Caso esteja editando seus dados ou de outro usuário é importante saber que só é necessário preencher a senha caso queira alterá-la, se quiser manter a mesma, ignore este campo.'));
echo $this->Form->input('confirma',array('required'=>false,'label'=>'Confirmação de senha','type'=>'password','data-step'=>'8','data-intro'=>'Aqui é fácil, este campo deve ficar igual o anterior.'));
?>
<div data-step="9" data-intro="Clique aqui para salvar.">
<?php
echo $this->Form->end('Salvar');
?>
</div>
</div>