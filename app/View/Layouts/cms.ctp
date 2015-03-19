<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		CMS Inline - Administrador de Páginas Web Ajax
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap','font-awesome','dataTables','admin'));
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
<iframe id="cms-site" src="<?php echo $url;?>?javascript=off" scrolling="auto" ></iframe>

<?php
if($editor):
$editor=(is_array($editor))?$editor:array();
$editor['linha']=(isset($editor['linha']))?$editor['linha']:true;
$editor['coluna']=(isset($editor['coluna']))?$editor['coluna']:true;
$editor['apaga']=(isset($editor['apaga']))?$editor['apaga']:true;
$editor['ckeditor']=(isset($editor['ckeditor']))?$editor['ckeditor']:true;
?>

<div id="edicao" class="dragg">
    <div class="navbar container-fluid">
        <div class="navbar-inner">
            <div class="brand  row">
             Edição
            </div>
            <ul class="nav icons row">
                <li>
                    <a href="#" id="Salvar" class="ttip" data-edicao="salvar" data-placement="bottom" title="Salvar">
                        <i class="icon-save"></i>
                    </a>
                </li>
            </ul>
            <hr class="separador" />
            <ul class="nav icons row">
            <?php if($editor['linha']):?>
                <li>
                    <a href="#" class="ttip" data-edicao="linha" data-placement="bottom" title="Inserir Linha">
                        <i class="icon-reorder"></i>
                    </a>
                </li>
                <?php endif; if($editor['coluna']):?>
                <li>
                    <a href="#" class="ttip" data-edicao="coluna" data-placement="bottom" title="Inserir Coluna">
                        <i class="icon-th-large"></i>
                    </a>
                </li>
                <?php endif; if($editor['apaga']):?>
                <li>
                    <a href="#" class="ttip" data-edicao="apagar" data-placement="bottom" title="Apaga linha/coluna atual">
                        <i class="icon-remove"></i>
                    </a>
                </li>
                <?php endif;?>
            </ul>
			<?php /*
            <?php if($editor['ckeditor']):?>
            <hr class="separador" />
            <ul class="nav icons row">
                <li>
                    <a href="#" class="ttip" data-edicao="html" data-placement="top" title="Inserir Texto/Html">
                        <i class="icon-font"></i>
                    </a>
                </li>
            </ul>
            <?php endif;?>*/?>
        </div>
    </div>
</div>
<?php endif;?>
<!-- INICIA O CARREGADOR -->
<div id="ajax-admin" class="modal show fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="modal-label"></h3>
  </div>
  <div class="modal-body">
    
  </div>
</div>
<!-- TERMINA O CARREGADOR -->

<!-- INICIA O CARREGADOR -->
<div id="carregador" class="modal show fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="modal-label text-center">Carregando</h3>
  </div>
  <div class="modal-body">
    <p class="modal-mensagem text-center">Aguarde alguns instantes...</p>
    <div class="progress progress-striped active">
    	<div class="bar bar-success" style="width: 100%;"></div>
    </div>
  </div>
</div>
<!-- TERMINA O CARREGADOR -->   
<!-- INICIA O FORMULÁRIO -->
<?php
	echo $this->Form->create('Pagina');
	echo $this->Form->hidden('corpo');
	echo $this->Form->end();
	
?>
<!-- TERMINA O FORMULÁRIO -->

	<script type="text/javascript">
		base_url='<?php echo $this->webroot;?>';
		base_id='<?php echo $id;?>';
	</script> 
	<?php
		echo $this->Html->script(array('jquery.min','jquery-ui.min','bootstrap','dataTables','admin'));
		echo $this->fetch('script');
	?>
</body>
</html>
