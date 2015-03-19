<?php
class EnviaEmailsController extends AppController {
	
	public $uses = array();
	
	public function envia($email=null){
            $redirect=$this->referral();

            if(is_array($email)){
                $email['EnviaEmail']=$email;
            }elseif($this->request->is('post')||$this->request->is('put')){
                $email=$this->request->data;
            }else{
                return $this->redirect($redirect);
            }

            $configs=$this->Session->read('Configuracao');

            if(!$configs['email_agendamento']) $email['EnviaEmail']['enviado']=1;

            $agendamento=$this->__agendaEnvio($email);
            if($configs['email_agendamento']){
                    if($agendamento)$redirect=$agendamento;
            }else{
                    $envio=$this->__enviaAgora($email);
                    if($envio)$redirect=$envio;
            }

            return $this->redirect($redirect);
	}
	
	public function __agendaEnvio($email=array()){
		
            $redirect = false;

            if(!empty($email['EnviaEmail']['redirect']))
                    $redirect=$email['EnviaEmail']['redirect'];
                    unset($email['EnviaEmail']['redirect']);
		
            $this->EnviaEmail->create();
            if($this->EnviaEmail->save($email)){
                $this->Session->setFlash('Email enviado com sucesso','sucesso');
            }else{
                $this->Session->setFlash('Email não pode ser enviado!','erro');
            }
                        
            return $redirect;
	}
	
	public function __enviaAgora($email=array()){
		
		$redirect = false;
		
		if(!empty($email['EnviaEmail']['redirect']))
                    $redirect=$email['EnviaEmail']['redirect'];
                    unset($email['EnviaEmail']['redirect']);
		
                $this->EnviaEmail->emailConfig();
		$retorno=$this->EnviaEmail->enviaAgora($email);
		if($retorno['status']){
                    $this->Session->setFlash('Email enviado com sucesso','sucesso');
                }else{
                    $this->Session->setFlash('Email não pode ser enviado!','erro');
                }
                
		return $redirect;
	}
	
}