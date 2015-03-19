<?php

class CategoriasController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		if(empty($this->request->params['model']))throw new NotFoundException(__('Página não encontrada'));
		if(!
			$this->Categoria->find('count',array(
				'conditions'=>array('Categoria.titulo'=>$this->request->params['model'])
			))
		){
			throw new NotFoundException(__('Categoria não encontrada'));
		}
		$this->set('categoria_pai',$this->request->params['model']);
		
		$pass=$this->request->params['pass'];
		unset($this->request->params['pass']);
		$this->request->params['pass']=array();
		
		$i=0;
		
		foreach($pass as $value){
			if($i!=0){
				$this->request->params['pass'][$i-1]=$value;
			}
			$i++;
		}
		
		$categoriaPai=$this->Categoria->find('first',array(
			'conditions'=>array('Categoria.titulo'=>$this->request->params['model']),
			'fields'=>array('Categoria.id','Categoria.titulo'),
		));
		
		Configure::write('categoriaPai',$categoriaPai);
		
	}
	
	public function beforeRender(){
		parent::beforeRender();
		$this->set('active','galerias');
	}
	
	public function admin_index(){
		$categoriaPai=Configure::read('categoriaPai');
		
		$retorno = $this->Categoria->find('all',array(
			'order'=>array('Categoria.lft'),
			'recursive'=>0,
			'conditions'=>array('Categoria.parent_id'=>$categoriaPai['Categoria']['id'])
		));
		$this->set('retorno',$retorno);
	}
	
	public function admin_add(){
		if($this->request->is('post')||$this->request->is('put')):
			$this->Categoria->create();
			$categoriaPai=Configure::read('categoriaPai');
			$this->request->data['Categoria']['parent_id']=$categoriaPai['Categoria']['id'];
			if($this->Categoria->save($this->request->data)){
				$this->Session->setFlash(__('Categoria salva com sucesso!'),'sucesso');
				return $this->redirect(array(
					'admin'=>true,
					'controller'=>'Categorias',
					'action'=>'edita',
					$categoriaPai['Categoria']['titulo'],
					$this->Categoria->getLastInsertID()
				));
			}
				$this->Session->setFlash(__('Categoria não pode ser salva!'),'erro');
		endif;
	}
	
	public function admin_edita($id=null){
		$this->Categoria->id=$id;
		if(!$this->Categoria->exists())throw new NotFoundException(__('Categoria não encontrada'));
		if($this->request->is('post')||$this->request->is('put')):
			if(empty($this->request->data['Categoria']['parent_id'])){
				$this->request->data['Categoria']['parent_id']=$categoriaPai['Categoria']['id'];
			}
			if($this->Categoria->save($this->request->data)){
				$this->Session->setFlash(__('Categoria salva com sucesso!'),'sucesso');
			}
				$this->Session->setFlash(__('Categoria não pode ser salva!'),'erro');
		else:
			$this->request->data=$this->Categoria->read();
		endif;
	}
	
	public function admin_sobe($id=null){
		$this->Categoria->id=$id;
		if(!$this->Categoria->exists())throw new NotFoundException(__('Categoria não encontrada'));
		$this->Categoria->moveUp($id,abs(1));
		$this->Session->setFlash(__('Posição da Categoria alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index'));
	}
	
	public function admin_desce($id=null){
		$this->Categoria->id=$id;
		if(!$this->Categoria->exists())throw new NotFoundException(__('Categoria não encontrada'));
		$this->Categoria->moveDown($id,abs(1));
		$this->Session->setFlash(__('Posição da Categoria alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index'));
	}
	
	public function admin_remove($id=null){
		$this->Categoria->id = $id;
		if(!$this->Categoria->exists())throw new NotFoundException('Categoria inexistente');
		if($this->Categoria->delete()):
			$this->Session->setFlash(__('Categoria removida com sucesso!'),'sucesso');
			return $this->redirect(array('action'=>'index'));
		endif;
		$this->Session->setFlash(__('Categoria não pode ser removida!'),'erro');
		return $this->redirect(array('admin'=>true,'controller'=>'Categorias','action'=>'index','model'=>$categoriaPai['Categoria']['titulo']));
	}
	
}