<?php $this->Html->addCrumb($conteudo['title']); ?>
<?php echo $this->element('temas/breadcrumb');?>
<div class="container text-center">
	<ul class="thumbnails">
    <?php foreach($retorno as $key=>$value):?>
    <?php if(count($value['Imagem'])):?>
    <?php
    	if(!isset($value['Categoria'][0]['slug'])){
			$value['Categoria'][0]['slug']='';
		}else{
			$value['Categoria'][0]['slug']=$value['Categoria'][0]['slug'].'/';
		}
	?>
        <li class="span3">
            <a href="<?php echo $this->Html->url('/'.$conteudo['slug']).'/ver/'.$value['Categoria'][0]['slug'].$value['Galeria']['slug'];?>" class="thumbnail">
                <?php echo $this->Html->image('upload/medio/'.$value['Imagem'][0]['url']);?>
                <h3><?php echo $value['Galeria']['titulo'];?></h3>
                <p><?php if(isset($value['Categoria'][0]['titulo'])) echo $value['Categoria'][0]['titulo'];?></p>
            </a>
        </li>
        <?php endif;?>
        <?php endforeach;?>
     </ul>
</div>