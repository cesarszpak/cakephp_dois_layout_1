<?php

App::uses('Component', 'Controller');
class CmsComponent extends Component {
	
	public $controller;
	public $pagina;
	
	public function initialize(Controller $controller) {
		$this->controller = $controller;
	}
	
	public function returnPagina($slug=null){
		if($slug==null){
			$slug=Inflector::slug($this->controller->request->url,'-');
			if(empty($slug))$slug='home';
		}
		$this->Pagina = ClassRegistry::init('Pagina');
		$conteudo=$this->Pagina->find('first',array('conditions'=>array('slug'=>$slug,'habilitar'=>'1'),'fields'=>array('title','descricao','tags','slug')));
		
		if(count($conteudo)==0)throw new NotFoundException(__('Ops! Página não encontrada'));
		
		$conteudo = $conteudo['Pagina'];
		$seo['title']=$conteudo['title'];
		$seo['tags']=$conteudo['tags'];
		$seo['descricao']=$conteudo['descricao'];
		$this->controller->set('conteudo',$conteudo);
		$this->controller->set('seo',$seo);
		
		return $conteudo;
	}
	
	public function returnItem($conteudo,$uses=null,$pagina=true){
		
		if($pagina){
			$atualurl=explode('/',$this->controller->request->url);
			$this->Pagina = ClassRegistry::init('Pagina');
			$pagina=$this->Pagina->find(
				'first',
				array(
					'conditions'=>array('slug'=>$atualurl[0]),'fields'=>array('titulo','title','descricao','tags','slug'
				)
			));
			$this->controller ->set('pagina',$pagina);
		}
		
		if(empty($uses)){
			$uses = $this->controller->uses;
			if(is_array($uses))$uses=$uses[0];
		}else{
			if(is_array($uses))$uses=$uses[0];
		}
		
		if(!is_array($conteudo))
			throw new InternalErrorException(__('Ops! Valor errado para o conteúdo, array é o esperado'));
			
		if(!array_key_exists('title',$conteudo[$uses]))
			throw new InternalErrorException(__('Ops! O parametro title não foi enviado no array'));
			
		if(!array_key_exists('tags',$conteudo[$uses]))
			throw new InternalErrorException(__('Ops! O parametro tags não foi enviado no array'));
		
		if(!array_key_exists('descricao',$conteudo[$uses]))
			throw new InternalErrorException(__('Ops! O parametro descricao não foi enviado no array'));
		
		$seo['title']=$conteudo[$uses]['title'];
		$seo['tags']=$conteudo[$uses]['tags'];
		$seo['descricao']=$conteudo[$uses]['descricao'];
		$this->controller ->set('conteudo',$conteudo);
		$this->controller ->set('seo',$seo);
	}
	
}