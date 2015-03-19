<?php

//App::uses('Seo', 'Model');

class SeoRoute extends CakeRoute
{
	
	//O controller principal que recebe a url no caso de não existir um controller associado
	//Sem o Controller.php, ou seja para PagesController.php, apenas o Pages
	
	public $Controller_Default='Paginas';
	
	//A action principal que recebe a url no caso de não existir um action associado
	public $Action_Default='mostra';
	
	//Pego os controllers existentes
	
	function getControllers(){
		$controllers = App::objects('Controller');
		return $controllers;
	}
	
	//Verifico se os controllers existem
	
	function checkControllers($controller,$controllers){
		$controller = ucfirst($controller) . 'Controller';
		$check = false;
		if(in_array($controller,$controllers)) $check=true;
		return $check;
	}
	
	function urlToArray($url){
		if ($url==null)$url='/home';
		$parts=explode('/',$url);
		unset($parts[0]);
		return $parts;
	}
	
	//retorno o array com os parametros para o routes
	function urlReturn($parts){
		$controller=$parts[1];
		$action=(isset($parts[2]))?$parts[2]:false;
		
		if($this->checkControllers($controller,$this->getControllers())){
			$url['controller'] = $controller;
			$url['action']=($action)?$action:'index';
			unset($controller);
			unset($action);
		}else{
			App::import('Model', 'Pagina');
			$Pagina = new Pagina();
			$find=$Pagina->find('first',array(
				'conditions'=>array(
					'slug'=>$controller
				),
				'fields'=>array(
					'controller'
				)
			));
			if(empty($find['Pagina']['controller'])){
				$url['controller']=$this->Controller_Default;
				$url['action']=$this->Action_Default;
			}else{
				$url['controller']=$find['Pagina']['controller'];
				$url['action']=($action)?$action:'index';
				unset($controller);
				unset($action);
			}
		}
		unset($parts[1]);
		unset($parts[2]);
		if(isset($controller)){
			$url['pass'][0]='/'.$controller;
			if($action) $url['pass'][0].='/'.$action;
			foreach($parts as $key=>$value){
				$url['pass'][0].='/'.$value;
			}
			$url['pass'][0] = substr($url['pass'][0],1,strlen($url['pass'][0]));
		}else{
			foreach($parts as $key=>$value){
				$url['pass'][$key]=$value;
			}	
		}
		
		return $url;
	}
	
	public function parse($slug){
		$prefix=array('admin','ajax','cms');
		$url=$this->urlToArray($slug);
		if(!in_array($url[1],$prefix)){
			$routes=$this->urlReturn($url);
			return $routes;
		}
		return false;
	}
}