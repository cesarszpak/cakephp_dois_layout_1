<?php $this->Html->addCrumb($pagina['Pagina']['titulo'],'/'.$pagina['Pagina']['slug']); ?>
<?php $this->Html->addCrumb($conteudo['Categoria']['titulo']); ?>
<div class="container text-center">
	<ul class="thumbnails">
    <?php foreach($conteudo['Galeria'] as $key=>$value):?>
    <?php if(count($value['Imagem'])):?>
    <?php
    	if(!isset($conteudo['Categoria']['slug'])){
			$conteudo['Categoria']['slug']='';
		}else{
			$conteudo['Categoria']['slug']=$conteudo['Categoria']['slug'].'/';
		}
	?>
        <li class="span3">
            <a href="<?php echo $this->Html->url('/'.$pagina['Pagina']['slug']).'/ver/'.$conteudo['Categoria']['slug'].$value['slug'];?>" class="thumbnail fancy" rel="galeria">
                <?php echo $this->Html->image('upload/medio/'.$value['Imagem'][0]['url']);?>
                <h3><?php echo $value['titulo'];?></h3>
            </a>
        </li>
        <?php endif;?>
        <?php endforeach;?>
     </ul>
</div>