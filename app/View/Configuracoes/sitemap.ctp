<?php if(is_array($sitemap)):?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>
<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php foreach($sitemap as $value): ?>
<?php $value = $value['Pagina'];?>
<url>
    <loc><?php echo $this->Html->url('/', true).$value['slug'];?></loc>
    <priority><?php if($value['slug']=='home'||$value['slug']=='Home'){echo '1.000';}else{echo '0.500';};?></priority>
    <lastmod><?php 
			$modified = explode(' ',$value['modified']);
			echo $modified[0]; ?></lastmod>
    <changefreq>weekly</changefreq>
</url>
<?php endforeach; ?>
</urlset>
<?php else: ?>
<?php endif; ?>