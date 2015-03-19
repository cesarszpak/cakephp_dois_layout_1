<?php

class PaginasController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->action=='ajax_mostra')$this->action='mostra';
		$this->Auth->allow(array('mostra','menu'));
	}
	
	public function beforeRender(){
		parent::beforeRender();
		$this->set('active','paginas');
	}
	
	//abre o CMS Inline
	public function cms_edita($slug=null){
		if($slug==null)$slug='home';
		$url=Router::url('/', true).$slug;
		
		$id=$this->Pagina->find('first',array('conditions'=>array('slug'=>$slug),'fields'=>array('id','controller')));
		
		$this->set('url',$url);
		$this->set('id',$id['Pagina']['id']);
		
		if(!empty($id['Pagina']['controller'])){
			$model=Inflector::singularize($id['Pagina']['controller']);
			$this->loadModel($model);
			$this->set('editor',$this->$model->editor());
		}else{
			$this->set('editor',true);
		}
		
	}
	
	//Lista as páginas na adminstração
	public function admin_index(){
		$retorno =$this->Pagina->find('all',array('order'=>'lft'));
		$this->set('retorno',$retorno);
	}
	
	//mostra as páginas do site
	public function mostra($slug=null){
		$conteudo=$this->Pagina->find('first',array('conditions'=>array('slug'=>$slug,'habilitar'=>'1'),'fields'=>array('title','descricao','tags','slug','corpo')));
		if(count($conteudo)==0)throw new NotFoundException(__('Ops! Página não encontrada'));
		
		$conteudo = $conteudo['Pagina'];
		$seo['title']=$conteudo['title'];
		$seo['tags']=$conteudo['tags'];
		$seo['descricao']=$conteudo['descricao'];
		$this->set('conteudo',$conteudo);
		$this->set('seo',$seo);
		$this->render('mostra');
	}
	
	public function menu(){
		if($this->request->is('requested')){
			$menu=$this->Pagina->find('all',array(
				'conditions'=>array(
					'menu'=>1,
					'habilitar'=>1
				),
				'order'=>'lft'
			));
			return $menu;
		}
	}
	
	//ADMINISTRAÇÃO AJAX
	
	public function ajax_edita($id=null){
		$this->Pagina->id=$id;
		if(!$this->Pagina->exists())throw new NotFoundException(__('Página não encontrada'));
		if($this->request->is('post')||$this->request->is('put')):
			if($this->Pagina->save($this->request->data)){
				$this->Session->setFlash(__('Página salva com sucesso!'),'sucesso');
			}else{
				$this->Session->setFlash(__('Página não pode ser salva!'),'erro');
			}
		endif;
	}
	
	//lista as páginas
	public function ajax_index(){
		$retorno =$this->Pagina->find('all',array('order'=>'lft'));
		$this->set('retorno',$retorno);
	}
	
	public function admin_add(){
		if($this->request->is('post')||$this->request->is('put')):
			$this->Pagina->create();
			if($this->Pagina->save($this->request->data)){
				$this->Session->setFlash(__('Página salva com sucesso!'),'sucesso');
				return $this->redirect(array('action'=>'edita',$this->Pagina->getLastInsertId()));
			}
				$this->Session->setFlash(__('Página não pode ser salva!'),'erro');
		endif;
	}
	
	public function admin_edita($id=null){
		$this->Pagina->id=$id;
		if(!$this->Pagina->exists())throw new NotFoundException(__('Página não encontrada'));
		if($this->request->is('post')||$this->request->is('put')):
			if($this->Pagina->save($this->request->data)){
				$this->Session->setFlash(__('Página salva com sucesso!'),'sucesso');
			}else{
				$this->Session->setFlash(__('Página não pode ser salva!'),'erro');
			}
		endif;
		$this->request->data=$this->Pagina->read();
	}
	
	public function admin_sobe($id=null){
		$this->Pagina->id=$id;
		if(!$this->Pagina->exists())throw new NotFoundException(__('Página não encontrada'));
		$this->Pagina->moveUp($id,abs(1));
		$this->Session->setFlash(__('Posição da página alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index'));
	}
	
	public function admin_desce($id=null){
		$this->Pagina->id=$id;
		if(!$this->Pagina->exists())throw new NotFoundException(__('Página não encontrada'));
		$this->Pagina->moveDown($id,abs(1));
		$this->Session->setFlash(__('Posição da página alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index'));
	}
	
	public function admin_remove($id=null){
		$this->Pagina->id = $id;
		if(!$this->Pagina->exists())throw new NotFoundException('Página inexistente');
		if($this->Pagina->delete()):
			$this->Session->setFlash(__('Página removida com sucesso!'),'sucesso');
			return $this->redirect(array('action'=>'index'));
		endif;
		$this->Session->setFlash(__('Página não pode ser removida!'),'erro');
		return $this->redirect(array('action'=>'index'));
	}
}