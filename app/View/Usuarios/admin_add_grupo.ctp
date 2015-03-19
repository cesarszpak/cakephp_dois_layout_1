<div data-step="1" data-intro="Aqui você pode editar ou criar um usuário novo usuário, bastando confirmar clicando em Salvar no rodapé do formulário, os campos serão validados e uma mensagem será mostrada caso algo não esteja de acordo.">
    <?php echo $this->Form->create('Usuario',array('class'=>'form-horizontal')); ?>
    <legend>Adicionando novo grupo de usuários</legend>
    <?php
        echo $this->Form->input('alias');
    ?>
    <div data-step="8" data-intro="Clique aqui para salvar.">
    <?php
    echo $this->Form->end('Salvar');
    ?>
    </div>
</div>