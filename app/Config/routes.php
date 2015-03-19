<?php

	Router::parseExtensions('pdf');

	Router::connect('/admin', array('controller' => 'Painel', 'action' => 'home','prefix'=>'admin'));
 	Router::connect('/cms/paginas', array('controller' => 'Paginas', 'action' => 'edita','prefix'=>'cms'));
	Router::connect('/cms/paginas/:slug', array('controller' => 'Paginas', 'action' => 'edita','prefix'=>'cms'),array(
		'pass'=>array('slug')
	));
	
	Router::connect('/Usuarios/login', array('controller' => 'Usuarios', 'action' => 'login','prefix'=>'admin'));
	
	Router::connect('/js/estatisticas.js', array('controller' => 'Estatisticas', 'action' => 'js','prefix'=>'ajax'));
	
	Router::connect('/cms/paginas/:slug', array('controller' => 'Paginas', 'action' => 'edita','prefix'=>'cms'),array(
		'pass'=>array('slug')
	));
	
	Router::connect('/ajax/:slug', array(
		'controller' => 'Paginas', 'action' => 'mostra','prefix'=>'ajax'
	),array(
		'pass'=>array('slug'),
	));
	
	Router::connect('/robots.txt', array('controller' => 'Configuracoes', 'action' => 'robots'));
	Router::connect('/sitemap.xml', array('controller' => 'Configuracoes', 'action' => 'sitemap'));
	
	Router::connect('/instala/instala', array('plugin' => 'Instala', 'controller' => 'Instala', 'action' => 'index'));
	Router::connect('/Instala/Instala/:action', array('plugin' => 'Instala', 'controller' => 'Instala'));
	
	Router::connect('/admin/Categorias/:model', array('controller' => 'Categorias','action' => 'index', 'prefix' => 'admin'),array(
		'pass'=>array('model')
	));
	
	Router::connect('/admin/Categorias/:action/:model/*', array('controller' => 'Categorias', 'prefix' => 'admin'),array(
		'pass'=>array('model'),
		'model'=>'[a-zA-Z0-9]+'
	));
	
	CakePlugin::routes();
		
	App::import('Lib', 'SeoRoute');
	
	Router::connect('/', array(),array('routeClass' => 'SeoRoute'));
	
	Router::connect(':slug', array(),array('routeClass' => 'SeoRoute'));
	
	require CAKE . 'Config' . DS . 'routes.php';


