<?php

class InstalaController extends InstalaAppController {
	public $name = 'Instala';
	
	public function beforeRender(){
		$this->layout = 'Instala.default';
	}
	
	public function index() {
		App::uses('SchemaInstallShell', 'Instala.Console/Command');
		$this->My = new SchemaInstallShell();
		$this->My->startup();
		$db = ConnectionManager::getDataSource('default');
		$db = $db->listSources();
		$tables = array_diff($this->My->checkInstalacao(),$db);
		if(count($tables)==0){
			return($this->redirect(array('action'=>'cadAdmin')));
		}
	}
	
	public function bancodedados(){
		
			App::uses('SchemaInstallShell', 'Instala.Console/Command');
			$this->My = new SchemaInstallShell();
			
			$file='schema';
			$underscore='';
			$snapshot='';
			$i=0;
			while(file_exists(APP.'Config'.DS.'Schema'.DS.$file.$underscore.$snapshot.'.php')){
				$underscore='_';
				$i++;
				$snapshot=$i;
			}
			$snapshot=$snapshot-1;
			$this->My->params['snapshot']=$snapshot;
			
			$this->My->startup();
			$db = ConnectionManager::getDataSource('default');
			$db = $db->listSources();
			$tables = array_diff($this->My->checkInstalacao(),$db);
			if(count($tables)!=0){
				$this->My->instala();
			}else{
				return($this->redirect(array('action'=>'cadAdmin')));
			}
	}
	
	public function cadAdmin(){
		$this->loadModel('Usuario');
		if($this->Usuario->find('count')>0)return $this->redirect(array('action'=>'configs'));
		if($this->request->is('post')||$this->request->is('put')){
			$this->Usuario->create();
			$this->request->data['Usuario']['grupo']=1;
			$this->request->data['Usuario']['ativo']=1;
			if($this->Usuario->save($this->request->data)){
				$this->__cadastra_acl($this->request->data,$this->Usuario->id);
				$this->Session->write('Contato',$this->request->data['Usuario']);
				return $this->redirect(array('action'=>'configs'));
			}else{
				$this->Session->setFlash('Não pode ser criado o usuário administrador, tente novamente!');
			}
		}
	}
	public function configs(){
		$this->loadModel('Configuracao');
		if($this->Configuracao->find('count')>0)throw new ForbiddenException(__('Ops! você não pode fazer isso'));
		if($this->request->is('post')||$this->request->is('put')){
			
			$this->request->data['Configuracao']['robots']='User-agent: * 
Disallow: /admin';
			$this->request->data['Configuracao']['timezone']='America/Sao_Paulo';
			$this->request->data['Configuracao']['title']=$this->request->data['Configuracao']['titulo'];
			if($this->request->data['Configuracao']['fone']==null)
			$this->request->data['Configuracao']['fone']=0;
			
			if($this->request->data['Configuracao']['cel']==null)
			$this->request->data['Configuracao']['cel']=0;
			
			$this->request->data['Configuracao']['grupo']=1;
			
			$this->Configuracao->create();
			if($this->Configuracao->save($this->request->data)){
				$this->Session->delete('Contato');
				return $this->redirect('/');
			}else{
				$this->Session->setFlash('As configurações não puderam ser criadas, tente novamente!');
			}
		}
		$contato=$this->Session->read('Contato');
		$this->request->data['Configuracao']['nomecontato']=$contato['nome'].' '.$contato['sobrenome'];
		$this->request->data['Configuracao']['email']=$contato['email'];
		
	}
	
	
	protected function __cadastra_acl($request,$id=null){
		$request=$request['Usuario'];
		$request['id']=$id;
		$aro = $this->Acl->Aro;
		$request['id_aro'] = $aro->find('first',array(
			'conditions'=>array('foreign_key'=>$request['id']),
			'fields'=>array('id')
		));
		
		if(!empty($request['id_aro'])){
			$request['id_aro']=$request['id_aro']['Aro']['id'];
		}else{
			$request['id_aro']=null;
		}
		$aro->id = $request['grupo'];
		if(!$aro->exists())throw new NotFoundException('Grupo inexistente');
			
		$save=array(   
			'model'        => 'Usuario',   
			'parent_id'    => $request['grupo'],   
			'alias'        => 'Usuario::'.$request['id'],
		);
		$save['foreign_key']=$request['id'];
		$save['id']=$request['id_aro'];
		unset($request['id_aro']);
		if(empty($request['id'])) $aro->create();
		if($aro->save($save)){
			return true;
		}
		return false;
	}
	
	
}