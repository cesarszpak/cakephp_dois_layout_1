<?php
class GaleriasController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','ver'));
	}
	
	public function beforeRender(){
		parent::beforeRender();
		$this->set('active','galerias');
	}
	
	public function index(){
		$this->Cms->returnPagina();
		
		$categoriaPai=$this->__categoriaPai();
		
		$retorno=$this->Galeria->find('all',array('contain'=>array(
				'Categoria'=>array(
					//'fields'=>array('Categoria.titulo'),
					'conditions'=>array(
						'Categoria.habilitar'=>'1',
						'Categoria.parent_id'=>$categoriaPai['Categoria']['id']
					),
					//'limit'=>1,
				),
				'Imagem'=>array(
					'fields'=>array('Imagem.titulo','Imagem.descricao','Imagem.url'),
					'order'=>array('Imagem.lft'),
					'conditions'=>array('Imagem.habilitar'=>'1'),
					//'limit'=>4,
				),
			),
			'fields'=>array('Galeria.titulo','Galeria.slug'),
			'order'=>array('Galeria.lft'),
			'conditions'=>array('Galeria.habilitar'=>'1'),
		));
		$this->set('retorno',$retorno);
	}
	
	
	/* QUERO DEIXAR CLARO AQUI QUE CASO NÃO SEJA ENVIADA O NOME DA GALERIA ($gal), ENTÃO SERÁ EXIBIDA A GALERIA*/
	public function ver($cat=null,$gal=null){
		
		$slug=($gal==null)?$cat:$gal;
		
		if($slug==null)throw new NotFoundException(__('Ops! Galeria não encontrada'));
		
		//se a galeria foi enviada então já envio direto pra lista de imagens dela
		if($gal!=null){
			$conteudo=$this->Galeria->find('first',array('contain'=>array(
					'Categoria'=>array(
						//'fields'=>array('Categoria.titulo'),
						'conditions'=>array('Categoria.habilitar'=>'1'),
						'limit'=>1,
					),
					'Imagem'=>array(
						'fields'=>array('Imagem.titulo','Imagem.descricao','Imagem.url'),
						'order'=>array('Imagem.lft'),
						'conditions'=>array('Imagem.habilitar'=>'1'),
					),
				),
				'conditions'=>array('slug'=>$slug)
			));
			
			if(!empty($conteudo['Categoria']));
			
			if(count($conteudo)==0)throw new NotFoundException(__('Ops! Galeria não encontrada'));
			
			$this->Cms->returnItem($conteudo);
		}else{
			
			//se a galeria não foi enviada, apenas a tacegorias eu preciso saber se existe alguma categoria com esse nome
			//e se não existir, eu verifico se tem galerias com esse nome
			
			$categoria=null;
			
			$conteudo=$this->Galeria->Categoria->find(
				'first',
				array(
					'conditions'=>array('Categoria.slug'=>$slug),
					'recursive'=>2
				)
			);
			
			if(count($conteudo)==0){
				$conteudo=$this->Galeria->find('first',array('contain'=>array(
						'Categoria'=>array(
							//'fields'=>array('Categoria.titulo'),
							'conditions'=>array('Categoria.habilitar'=>'1'),
							'limit'=>1,
						),
						'Imagem'=>array(
							'fields'=>array('Imagem.titulo','Imagem.descricao','Imagem.url'),
							'order'=>array('Imagem.lft'),
							'conditions'=>array('Imagem.habilitar'=>'1'),
						),
					),
					'conditions'=>array('slug'=>$slug)
				));
			}else{
				$categoria='Categoria';
			}
			
			if(count($conteudo)==0)throw new NotFoundException(__('Ops! Galeria não encontrada'));
			
			$this->Cms->returnItem($conteudo,$categoria);
			
			if($categoria)$this->render('cat');
		}
	}
	
	public function admin_index(){
		$retorno = $this->Galeria->find('all',array(
			'order'=>array(
				'Galeria.lft'
			),
			'fields'=>array(
				'Galeria.id',
				'Galeria.titulo',
			),
			'contain'=>array(
				'Categoria'=>array(
					'fields'=>(
						'Categoria.titulo'
					)
				)
			)
		));
		$this->set('retorno',$retorno);
	}
	
	public function admin_add(){
		if($this->request->is('post')||$this->request->is('put')):
			$this->Galeria->create();
			if($this->Galeria->saveAll($this->request->data)){
				$this->Session->setFlash(__('Galeria salva com sucesso!'),'sucesso');
				return $this->redirect(array('action'=>'index'));
			}
				$this->Session->setFlash(__('Galeria não pode ser salva!'),'erro');
		endif;
		
		$categoriaPai=$categoriaPai=$this->__categoriaPai();
		$this->set('categorias',$this->Galeria->Categoria->generateTreeList(
			array('Categoria.parent_id'=>$categoriaPai['Categoria']['id'])
		));
	}
	
	public function admin_edita($id=null){
		$this->Galeria->id=$id;
		if(!$this->Galeria->exists())throw new NotFoundException(__('Galeria não encontrada'));
		if($this->request->is('post')||$this->request->is('put')):
		$this->request->data['Galeria']['id']=$id;
			if($this->Galeria->saveAll($this->request->data)){
				$this->Session->setFlash(__('Galeria salva com sucesso!'),'sucesso');
				return $this->redirect(array('action'=>'index'));
			}
				$this->Session->setFlash(__('Galeria não pode ser salva!'),'erro');
		else:
			$this->request->data=$this->Galeria->find('first',array(
			'contain'=>array(
				'Categoria'=>array(
					'fields'=>(
						'Categoria.id'
					)
				)
			),
			'conditions'=>array(
				'Galeria.id'=>$id
			)
		));
		endif;

		$categoriaPai=$categoriaPai=$this->__categoriaPai();
		$this->set('categorias',$this->Galeria->Categoria->generateTreeList(
			array('Categoria.parent_id'=>$categoriaPai['Categoria']['id'])
		));
	}
	
	public function admin_sobe($id=null){
		$this->Galeria->id=$id;
		if(!$this->Galeria->exists())throw new NotFoundException(__('Galeria não encontrada'));
		$this->Galeria->moveUp($id,abs(1));
		$this->Session->setFlash(__('Posição da Galeria alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index'));
	}
	
	public function admin_desce($id=null){
		$this->Galeria->id=$id;
		if(!$this->Galeria->exists())throw new NotFoundException(__('Galeria não encontrada'));
		$this->Galeria->moveDown($id,abs(1));
		$this->Session->setFlash(__('Posição da Galeria alterada com sucesso!'),'sucesso');
		return $this->redirect(array('action'=>'index'));
	}
	
	function admin_remove($id=null){
		$this->Galeria->id = $id;
		if(!$this->Galeria->exists())throw new NotFoundException('Galeria inexistente');
		if($this->Galeria->delete()):
			$this->Session->setFlash(__('Galeria removida com sucesso!'),'sucesso');
			return $this->redirect(array('action'=>'index'));
		endif;
		$this->Session->setFlash(__('Galeria não pode ser removida!'),'erro');
		return $this->redirect(array('action'=>'index'));
	}
		
	/* SUPORTE */
	protected function __categoriaPai(){
		$categoriaPai=$this->Galeria->Categoria->find('first',array(
			'conditions'=>array('Categoria.titulo'=>$this->uses[0]),
			'fields'=>array('Categoria.titulo','Categoria.id'),
		));
		return $categoriaPai;
	}
	
}