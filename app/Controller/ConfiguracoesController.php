<?php

class ConfiguracoesController extends AppController{
	
	public $components = array('RequestHandler');
	
	public function admin_index(){
		$this->Configuracao->id=1;
		if(!$this->Configuracao->exists())$this->Configuracao->create();
		if($this->request->is('post')||$this->request->is('put')):
			if($this->Configuracao->save($this->request->data)){
				$this->Session->setFlash(__('Configuração salva com sucesso!'),'sucesso');
			}else{
				$this->Session->setFlash(__('Configuração não pode ser salva!'),'erro');
			}
		endif;
		$this->request->data=$this->Configuracao->read();
	}
	
	public function robots(){
		$this->layout='ajax';
		
		$this->RequestHandler->respondAs('text');
		$this->Configuracao->id = 1;
		$this->set('retorno',$this->Configuracao->read());
	}
	
	public function sitemap(){
		$this->layout='ajax';
		$this->Configuracao->id = 1;
		$retorno = $this->Configuracao->read();
		if($retorno['Configuracao']['sitemap']=='NULL'):
			$sitemap=$retorno['Seo'];
		else:
			$this->loadModel('Pagina');
			$sitemap = $this->Pagina->find('all');
		endif;
		$this->set('sitemap',$sitemap);
		$this->RequestHandler->respondAs('xml');
	}
	
}