<?php

class AclControlComponent extends Component {

	public $components = array(
		'Session',
		'Auth',
		'Acl',
	);
	
	public function checaPermicao(){
		//Se for passado um prefix e ele for admin ou cms
		if(
			(
				isset($this->request->params['prefix'])
			)
			and
			(
				($this->request->params['prefix']=='admin')
				or
				($this->request->params['prefix']=='cms')
			)
		){
			//se for um usuário logado
			if($this->Auth->User()){
				//se a action não for a admin_logout
				if($this->request->params['action']!='admin_logout'){
					//descubro o aro deste controller
					$aco=$this->__returnAcos($this->request->params['controller']);
					//e também mai detalhes do usuário
					$user=$this->Auth->User();
					//pego a lista de permissoes
					$permissoes=$this->Session->read('permissoes');
					$this->Session->delete('permissoes');
					//verifico es este usuário tem permissão de acesso a este controller, se não
					if((empty($permissoes[$aco]['permissao'])) or (!$permissoes[$aco]['permissao'])){
						//Se não tiver permissão eu redireciono para a página de perfil
						if($aco!='Usuario' and $this->request->params['action']!='admin_add')
						return $this->redirect(array('admin'=>true,'controller'=>'Usuarios','action'=>'add',$user['id']));
					}//fecho o bloco de checagem do acl
				}//fecho o bloco de checagem de action logout
			}//fecho o bloco de checagem de usuario logado
		}//fecho o bloco de checagem de prefix
	}
	
	public function setaPermicao(){
		if($this->Auth->User()){
			$user=$this->Auth->User();
			$userAcl=$this->Acl->Aro->find('first',array(
				'conditions'=>array('foreign_key'=>$user['id'])
			));
			$userAcl=$this->Acl->Aro->find('first',array(
				'conditions'=>array('id'=>$userAcl['Aro']['parent_id'])
			));

			foreach($userAcl['Aco'] as $value){
				$value['alias']=Inflector::camelize(Inflector::underscore($value['alias']));
				$permissoes[$value['alias']]['nome']=$value['alias'];
				$permissoes[$value['alias']]['permissao']=false;

				if(($value['Permission']['_read']=='1')and($value['Permission']['_update']=='1')and($value['Permission']['_delete']=='1')and($value['Permission']['_create']=='1')){
				   $permissoes[$value['alias']]['permissao']=true; 
				}
			}
			$this->Session->write('Permissoes',$permissoes);

			return $permissoes;
			
		}
	}
	
	public function cadastra_acl($request,$id=null){
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