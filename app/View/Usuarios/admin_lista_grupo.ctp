<div class="btn-group">
<?php echo $this->Html->link('Novo Grupo',array('controller'=>'Usuarios','action'=>'add_grupo'),array('class'=>'btn btn-info ttip','title'=>'Adiciona um novo grupo','data-step'=>'1','data-intro'=>'Caso queira definir um novo grupo de usuários, clique aqui')) ;?>
<?php echo $this->Html->link('Usuários',array('controller'=>'Usuarios','action'=>'index'),array('class'=>'btn btn ttip','title'=>'Voltar a lista de usuários')) ;?>
</div>
<hr />
<div class="pagina-controller">
<?php echo $this->Session->flash(); ?>
    <table class="table-ajax table table-striped table-hover table-bordered table-acl" data-step="3" data-intro="E aqui você tem a listagem de grupos criados anteriormente, você pode editar as permissões de qualquer grupo ou, até mesmo, remover um deles se quiser.">
        <thead>
            <tr>
                <th>Título</th>
                <?php
                foreach($retorno as $aco){
                    echo '<td>'.$aco['Aro']['alias'].'</td>';
                }?>
            </tr>
        </thead>
        <tbody>
                <?php $chaves=array_keys($retorno);?>
                <?php $i=0;?>
                <?php foreach($retorno[0]['Aco'] as $val){?>
                <tr>
                <?php foreach ($chaves as $value ) {
                    $aco=$retorno[$value]['Aco'][$i];
                    if(($aco['Permission']['_create']>0) and ($aco['Permission']['_read']>0) and ($aco['Permission']['_update']>0) and ($aco['Permission']['_delete']>0)){
                        $class_allow='btn btn-success btn-small';
                        $class_deny='btn btn-danger btn-small disabled cursor-hand';
                        $ttip= 'Permitido, clique para bloquear';
                        $action = 'deny';
                    }else{
                        $class_allow='btn btn-success btn-small disabled cursor-hand';
                        $class_deny='btn btn-danger btn-small';
                        $ttip='Bloqueado, clique para permitir';
                        $action = 'allow';
                    }
                    if ($val['Permission']['aro_id']==$aco['Permission']['aro_id']) {
                        echo '
                            <td>'.$aco['alias'].'</td>
                        ';
                   }
                    echo '<td>
                        <div class="btn-group ttip" title="'.$ttip.'">'.
                            $this->Html->link(
                                '<i class="icon-ok"></i>',
                                array(
                                    'action'=>'add_regra',
                                    $aco['alias'],
                                    $action,
                                    $aco['Permission']['aro_id'],
                                ),
                                array(
                                    'escape'=>false,
                                    'class'=>$class_allow
                                )
                            ).
                            $this->Html->link(
                                '<i class="icon-remove"></i>',
                                array(
                                    'action'=>'add_regra',
                                    $aco['alias'],
                                    $action,
                                    $aco['Permission']['aro_id'],
                                ),
                                array(
                                    'escape'=>false,
                                    'class'=>$class_deny
                                )
                            ).
                        '</div>
                    </td>';
                }
                $i++;
                ?>
                </tr>
            <?php
            }
            ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Título</th>
                <?php
                foreach($retorno as $aco){
                    echo '<td>'.$aco['Aro']['alias'].'</td>';
                }?>
            </tr>
        </tfoot>
    </table>
</div>
<hr />
<div class="btn-group">
<?php echo $this->Html->link('Novo Grupo',array('controller'=>'Usuarios','action'=>'add_grupo'),array('class'=>'btn btn-info ttip','title'=>'Adiciona um novo grupo','data-step'=>'2','data-intro'=>'Ou aqui, já que eles fazem a mesma coisa!')) ;?>
<?php echo $this->Html->link('Usuários',array('controller'=>'Usuarios','action'=>'index'),array('class'=>'btn btn ttip','title'=>'Voltar a lista de usuários')) ;?>
</div>