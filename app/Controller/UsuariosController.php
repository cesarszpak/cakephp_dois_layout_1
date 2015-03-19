<?php
App::uses('Security', 'Utility');
class UsuariosController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		if ($this->action == 'admin_login'){
			$this->action = 'login';
		}
		$this->Auth->allow(array('admin_perdiSenha','login','admin_logout'));
	}
	
	public function beforeRender(){
		parent::beforeRender();
		if ($this->action == 'admin_login'){
			$this->layout = 'default';
		}
	}
	
	public function login(){
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Usuario->set($this->request->data);
				if ($this->Auth->login()) {
					//adiciona 1 acesso
					$this->Usuario->id=$this->Auth->user('id');
					$this->Usuario->set('acessos',$this->Auth->user('acessos')+1);
					$this->Usuario->save();
					
					//seta o cookie
					if($this->request->data['Usuario']['lembrar']==1) $this->__criaLembrar($this->Usuario->read());					
					
					$this->Session->setFlash(__('Logado com sucesso!'), 'sucesso');
					return $this->redirect($this->Auth->redirectUrl());
				} else {
					$this->Session->setFlash(__('Usuário ou senha não encontrados, tente novamente ou verifique se sua conta está ativada!'), 'erro');
				}
		}else{
			if($this->Cookie->check('lembrar')) $this->__logaLembrar();
		}
		$this->render('login');
	}
	
	public function admin_index(){
		$retorno = $this->Usuario->find('all');
		$this->set('retorno',$retorno);
	}
	
	public function admin_add($id=null){
		if($id!=null){
			$this->Usuario->id=$id;
			if (!$this->Usuario->exists())throw new NotFoundException(__('Usuário inexistente'));
		}
		if($this->request->is('post') || $this->request->is('put')){
			if(empty($this->request->data['Usuario']['password']))unset($this->request->data['Usuario']['password']);
			if(empty($this->request->data['Usuario']['confirma']))unset($this->request->data['Usuario']['confirma']);
			
			$permissoes=$this->Session->read('Permissoes');
			$grupo=$this->request->data['Usuario']['grupo'];
			if(!$permissoes['Usuarios']['permissao'])unset($this->request->data['Usuario']['grupo']);
			if(empty($id)){
				$this->Usuario->create();
				$this->request->data['Usuario']['ativo']=1;
			}
			if($this->Usuario->save($this->request->data)){
				$this->Session->setFlash(__('Usuário criado com sucesso!'),'sucesso');
				if(empty($id)) $id=$this->Usuario->getLastInsertID();
				if($permissoes['Usuarios']['permissao'])$this->AclControl->cadastra_acl($this->request->data,$id);
			}else{
				$this->Session->setFlash(__('Alguma coisa está errada, verifique abaixo!'),'erro');
			}
            $this->request->data['Usuario']['grupo']=$grupo;
		}else if($id!=null){
			$user=$this->Usuario->read();
			unset($user['Usuario']['password']);
			$this->request->data=$user;
		}
		$aro = $this->Acl->Aro;
		$grupos = $aro->find('list',array(
			'conditions'=>array('parent_id'=>null),
			'fields'=>array('id','alias')
		));
		$this->set('grupos',$grupos);
		
	}
	
	public function admin_logout(){
		$this->Cookie->destroy('lembrar');
		$this->redirect($this->Auth->logout());
	}
	
	public function admin_perdiSenha(){
		if($this->request->is('post')||$this->request->is('put')){
			$login=$this->Usuario->findByEmail($this->request->data['Usuario']['username']);
			if(!$login){
				$login=$this->Usuario->findByUsername($this->request->data['Usuario']['username']);
			}
			
			if($login){
				$this->Usuario->id=$login['Usuario']['id'];
				$password=$this->Usuario->geraSenha(array('tamanho'=>8,'simbolos'=>false));
				$this->Usuario->set(array('password'=>$password));
				$this->Usuario->save();
				$login['Usuario']['password']=$password;
				$this->__enviaEmail($login);
			}else{
				$this->Session->setFlash(__('Não encontrei ninguém com este email ou usuário, tente outro!'),'erro');
			}
		}
	}
	
	public function admin_remove($id=null){
		$this->Usuario->id = $id;
		if(!$this->Usuario->exists())throw new NotFoundException('Usuario inexistente');
		if($this->Usuario->id==1){
			$this->Session->setFlash(__('Você não pode apagar este usuário!'),'erro');
			return $this->redirect(array('action'=>'index'));
		}
		if($this->Usuario->delete()):
			$this->Session->setFlash(__('Usuario removido com sucesso!'),'sucesso');
			return $this->redirect(array('action'=>'index'));
		endif;
		$this->Session->setFlash(__('Usuario não pode ser removido!'),'erro');
		return $this->redirect(array('action'=>'index'));
	}
        
	/* ACL */
	public function admin_add_grupo(){
		if($this->request->is('post')||$this->request->is('put')){
			$aro = $this->Acl->Aro;
			
			$data=$this->request->data;
			$data=$data['Usuario'];

			$aro->create();
			if($aro->save($data)){
				unset($this->request->data['Usuario']['alias']);
			}
		}
	}
	
	public function admin_add_regra($controller_name=null,$permissao='allow',$grupo=null){
		if($grupo==null)throw new NotFoundException(__('Grupo inexistente'));
		$aco = $this->Acl->Aco;
		$aro = $this->Acl->Aro;
		
		$controller=$aco->find(
			'first',array(
				'conditions'=>array(
					'alias'=>$controller_name
			   )
		   )
		);
			
		$id=null;
		if(isset($controller['Aco']['id'])) $id=$controller['Aco']['id'];
		
		$aco->id=$id;
		
		if ((!$aco->exists())and($id!=null)) throw new NotFoundException(__('Regra inexistente'));
		
		if($aco->id==null){
			$aco->save(array('alias'=>$controller_name));
			$aco->id=$aco->getLastInsertId();
		}
		
		$grupo=$aro->findById($grupo);
		$regra=$aco->read();
		if($permissao=='allow'){
			$this->Acl->allow($grupo['Aro']['alias'], $regra['Aco']['alias']);
		}else{
			$this->Acl->deny($grupo['Aro']['alias'], $regra['Aco']['alias']);
		}
		
		return $this->redirect(array('action'=>'lista_grupo'));
	}
	
	public function admin_lista_grupo(){
		App::uses('String', 'Utility');
		$aro = $this->Acl->Aro;
		$retorno = $aro->find('all',array(
			'conditions'=>array('parent_id'=>null)
		));
		
		$this->set('retorno',$retorno);
	}
	
	public function admin_remove_grupo($id=null){
		$aro = $this->Acl->Aro;
		$aro->id = $id;
		if(!$aro->exists())throw new NotFoundException('Grupo inexistente');
		if($this->Usuario->delete()):
			$this->Session->setFlash(__('Grupo removido com sucesso!'),'sucesso');
		endif;
		return $this->redirect(array('action'=>'lista_grupo'));
	}
	
	/* SUPORTE */
	protected function __criaLembrar($user){
		$user=$user['Usuario'];
		$user=array(
				'id'=>$user['id'],
				'user'=>$user['username'],
				'pass'=>$user['password']
		);

		$this->Cookie->write('lembrar', $user, true, '2 weeks');
	}
	
	protected function __logaLembrar(){
		$cookie=$this->Cookie->read('lembrar');
		$this->Usuario->id=$cookie['id'];
		$user=$this->Usuario->read();
		$user=$user['Usuario'];
		if($user['username']==$cookie['user']&&$user['password']==$cookie['pass']){
			unset($user['password']);
			if($this->Auth->login($user)){
				return $this->redirect($this->Auth->redirectUrl());
			}
		}
	}
	
	protected function __enviaEmail($usuario){
		$usuario=$usuario['Usuario'];
		
		
		
		App::uses('CakeEmail', 'Network/Email');
			$Email = new CakeEmail();
			$Email->from(array($usuario['email'] => $usuario['nome']))
				->to($usuario['email'])
				->emailFormat('html')
				->subject('Recuperação de senha');
				
		$mensagem = '
			<p>Olá '.$usuario['nome'].'</p>
			<p>Acabei de receber um pedido de recuperação de senha através do painel do seu site, por isso estou enviando uma nova, por razões de segurança a senha antiga não funciona mais e esta nova senha foi criptografada de forma irreversivel, portanto este email é o único registro legível que existe dela, anote em um local seguro ou acesse o site para altera-lá. </p>
			
			<p>Senha '.$usuario['password'].'</p>';
				
		$email['para']=$usuario['email'];
		$email['nome']=$usuario['nome'];
		$email['assunto']='Recuperação de senha';
		$email['mensagem']=$mensagem;
						$email['redirect']=false;
		$this->Usuario->envia($email);
		$this->Session->setFlash(__('%s, o seu email foi enviado com sucesso!',array($usuario['nome'])),'sucesso');
		
	}
	
}