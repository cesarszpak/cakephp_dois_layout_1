<?php

class ContatosController extends AppController {
	
	public $uses = array();
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}
	
	public function index()
	{
		$this->loadModel('Pagina');
		$conteudo=$this->Pagina->find('first',array('conditions'=>array('slug'=>$this->request->url),'fields'=>array('title','descricao','tags','slug','corpo')));
		$conteudo = $conteudo['Pagina'];
		$seo['title']=$conteudo['title'];
		$seo['tags']=$conteudo['tags'];
		$seo['descricao']=$conteudo['descricao'];
		$this->set('conteudo',$conteudo);
		$this->set('seo',$seo);
		
		//
		
		if ($this->request->is('post')||$this->request->is('put')) {
			
			$this->Contato->set($this->request->data);
			if($this->Contato->validates()){
				$dados=$this->request->data;
				$dados=$dados['Contato'];
				
				$mensagem='
					<p>Olá,</p>
					<p>Você acaba de receber este email, enviado através do site por '.$dados['nome'].'.</p>
					<p><strong>Os dados de contato informados são:</strong></p>
					<p>Telefone: '.$dados['telefone'].'.</p>
					<p>Email: '.$dados['email'].'.</p>
					<p><strong>E a mensagem enviada:</strong></p>
					<p>'.$dados['mensagem'].'</p>
				';
				
				$email['de']=$dados['email'];
				$email['para']=$dados['emailPara'];
				$email['assunto']='Contato pelo site';
				$email['mensagem']=$mensagem;
                                $email['redirect']=false;
				$this->Contato->envia($email);
                $this->Session->setFlash(__('%s, seu email foi enviado com sucesso, agradecemos o contato!',$dados['nome']),'sucesso');
			} else {
				$this->Session->setFlash(__('Por favor, verifique suas informações!'),'erro');
			}
		}
		
	}
	
}