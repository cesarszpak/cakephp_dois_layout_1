<?php if(!isset($seo)):?>
   <title><?php echo $configs['title'];?></title>
  <?php  echo $this->Html->meta('icon');?>
  <?php echo $this->fetch('meta');?>
<?php else:?>
    <title><?php echo $seo['title'].' > '.$configs['title'];?></title>
    <?php echo $this->Html->meta('icon');?>
    <?php if(!empty($seo['tags'])) :?><meta name="keywords" content="<?php echo $seo['tags'];?>" ><?php endif;?>
    <?php if(!empty($seo['descricao'])): ?><meta name="description" content="<?php echo $seo['descricao'];?>" ><?php endif;?>
<?php endif;?>
<?php
	echo $this->fetch('css');
	if(isset($user)):
?>
<script type="text/javascript" src="<?php echo $this->webroot;?>imgadmin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	base_url='<?php echo $this->webroot;?>';
</script> 
<?php endif;