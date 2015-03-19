<?php
App::uses('HtmlHelper', 'View/Helper');
class LinkHelper extends AppHelper {

	function home(){
		return $this->webroot;
	}
	function menu($array,$pai=null,$options=array()){
		
		$class = '';
		
		if(isset($options['class'])) $class = ' '.$options['class'];
		
		$menu=($pai == null)?'<ul class="nav'.$class.'">':'<ul class="dropdown-menu">';
			foreach($array as $key=>$value):
				$menu.=$this->geraMenuCampo($value,$array,$pai);
			endforeach;
		$menu .= '</ul>';
		return $menu;
	}
	function geraMenuCampo($value,$array,$pai){
		$value = $value['Pagina'];
		$continua=false;

		if(in_array($value['slug'],array('home','Home'))){
			$slug= $this->webroot;
		}else{
			$slug=$value['slug'];
		}
		
		$menu =($pai == null)?'<li>':'<li class="dropdown">';
		$menu .=($pai == null)?'<a href="'.$slug.'">'.$value['titulo'].'</a>':'<a href="'.$slug.'" class="dropdown-toggle" data-toggle="dropdown">'.$value['titulo'].' <b class="caret"></b></a>';
		foreach($array as $test):
			if($test['Pagina']['parent_id']==$value['id']){
				$continua=true;
			}
		endforeach;
		if($continua) $menu .=$this->menu($array,$value['id']);
		$menu .='
		</li>
		';
		return $menu;

	}
}