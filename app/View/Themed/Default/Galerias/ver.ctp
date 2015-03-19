<?php $this->Html->addCrumb($pagina['Pagina']['titulo'],'/'.$pagina['Pagina']['slug']); ?>
<?php if(!empty($conteudo['Categoria'])):?>
<?php $this->Html->addCrumb($conteudo['Categoria'][0]['titulo'],'/'.$pagina['Pagina']['slug'].'/ver/'.$conteudo['Categoria'][0]['slug']); ?>
<?php endif;?>
<?php $this->Html->addCrumb($conteudo['Galeria']['title']); ?>
<?php echo $this->element('temas/breadcrumb');?>
<div class="container">
    <div class="row">
        <div class="span12">
            <h1><?php echo $conteudo['Galeria']['title'];?></h1>
           <?php if(!empty($conteudo['Categoria'])):?> <p><small><strong>Categoria:</strong> <?php echo $this->Html->link($conteudo['Categoria'][0]['titulo'],'/'.$pagina['Pagina']['slug'].'/ver/'.$conteudo['Categoria'][0]['slug'],array('class'=>'btn btn-small'));?></small></p><?php endif;?>
            <p><small><strong>Criado em</strong> <?php echo $conteudo['Galeria']['created'];?></small></p>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <ul class="thumbnails">
				<?php foreach($conteudo['Imagem'] as $value):?>
                <li class="span3">
					<?php echo $this->Html->link(
                        $this->Html->image(
							'upload/medio/'.$value['url'],
							array(
								'title'=>$value['titulo'],
								'alt'=>$value['descricao'],
								'class'=>'ttip',
								'rel'=>$conteudo['Galeria']['title'],
							)
						),
						'/img/upload/full/'.$value['url'],
                        array(
                            'escape'=>false,
                            'class'=>'thumbnail fancy'
                        )
                    );?>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <div class="row">
    	<div class="span12">
        	<p><?php echo $this->Html->link('Voltar','/'.$pagina['Pagina']['slug'],array('class'=>'btn btn-info'));?></p>
        </div>
    </div>
</div>