<?php

class ImagensController extends AppController {
	public function beforeRender(){
		parent::beforeRender();
		$this->set('active','galerias');
	}
	
	public function admin_index($id){
		$this->Session->write('galeria_id',$id);
		$retorno = $this->Imagem->Galeria->find('all',array(
			'fields'=>array('id'),
			'contain'=>array(
				'Imagem'=>array(
					'order'=>array('Imagem.lft'),
					'fields'=>array(
						'Imagem.id','Imagem.titulo','Imagem.url'
					)
				)
			),
			'conditions'=>(array('Galeria.id'=>$id))
		));
		$this->set('retorno',$retorno);
	}
	
	public function admin_add($id=null){
		if($id==null)throw new NotFoundException(__('Galeria inválida'));
		$this->set('galeria_id',$this->Session->read('galeria_id'));
		if($this->request->is('post')||$this->request->is('put')):
			$this->Imagem->create();
			if($this->Imagem->saveAll($this->request->data)){
				$this->Session->setFlash(__('Imagem salva com sucesso!'),'sucesso');
				return $this->redirect(array('action'=>'index',$this->Session->read('galeria_id')));
			}
				$this->Session->setFlash(__('Imagem não pode ser salva!'),'erro');
		endif;
	}
	
	public function admin_edita($id=null){
		$this->Imagem->id=$id;
		if(!$this->Imagem->exists())throw new NotFoundException(__('Imagem não encontrada'));
		if($this->request->is('post')||$this->request->is('put')):
			if($this->Imagem->save($this->request->data)){
				$this->Session->setFlash(__('Imagem salva com sucesso!'),'sucesso');
				return $this->redirect(array('action'=>'index',$this->Session->read('galeria_id')));
			}
				$this->Session->setFlash(__('Imagem não pode ser salva!'),'erro');
		else:
			$this->request->data=$this->Imagem->read();
		endif;
	}
	public function admin_sobe($id=null){
		$this->Imagem->id=$id;
		if(!$this->Imagem->exists())throw new NotFoundException(__('Imagem não encontrada'));
		$this->Imagem->moveUp($id,abs(1));
		$this->Session->setFlash(__('Posição da imagem alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index',$this->Session->read('galeria_id')));
	}
	public function admin_desce($id=null){
		$this->Imagem->id=$id;
		if(!$this->Imagem->exists())throw new NotFoundException(__('Imagem não encontrada'));
		$this->Imagem->moveDown($id,abs(1));
		$this->Session->setFlash(__('Posição da imagem alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index',$this->Session->read('galeria_id')));
	}
	public function admin_remove($id=null){
		$this->Imagem->id = $id;
		if(!$this->Imagem->exists())throw new NotFoundException('Imagem inexistente');
		if($this->Imagem->delete()):
			$this->Session->setFlash(__('Imagem removida com sucesso!'),'sucesso');
			return $this->redirect(array('action'=>'index',$this->Session->read('galeria_id')));
		endif;
		$this->Session->setFlash(__('Imagem não pode ser removida!'),'erro');
		return $this->redirect(array('action'=>'index',$this->Session->read('galeria_id')));
	}
	
}