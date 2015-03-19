<?php
App::uses('EnviaEmail', 'Model');
App::uses('CakeSession', 'Model/Datasource');

class EnviaEmailsBehavior extends ModelBehavior {
    
	public $EnviaEmail;
	public $Session;
		
	public function envia(Model $Model, $email=null){

		$this->EnviaEmail = new EnviaEmail();
		$this->Session = new CakeSession();

		if(!$email['redirect'])$redirect=$_SERVER['HTTP_REFERER'];
		
		$configs=$this->Session->read('Configuracao');
		
		if(empty($email['nome']))$email['nome']=$configs['titulo'];
		if(empty($email['de']))$email['de']=$configs['email'];
		
		if(is_array($email)){
			$email['EnviaEmail']=$email;
		}else{
			header('Location: '.$redirect);
		}

		if(!$configs['email_agendamento']) $email['EnviaEmail']['enviado']=1;

		$agendamento=$this->__agendaEnvio($email);
		if($configs['email_agendamento']){
				if($agendamento)$redirect=$agendamento;
		}else{
				$envio=$this->__enviaAgora($email);
				if($envio)$redirect=$envio;
		}

		if(!$email['redirect']){
			header('Location: '.$redirect);
		}else{
			return true;
		}
	}

	function __agendaEnvio($email=array()){

		$redirect = false;

		if(!empty($email['EnviaEmail']['redirect']))
				$redirect=$email['EnviaEmail']['redirect'];
				unset($email['EnviaEmail']['redirect']);

		$this->EnviaEmail->create();
		$this->EnviaEmail->save($email);

		return $redirect;
	}

	function __enviaAgora($email=array()){

			$redirect = false;

			if(!empty($email['EnviaEmail']['redirect']))
				$redirect=$email['EnviaEmail']['redirect'];
				unset($email['EnviaEmail']['redirect']);

			$this->EnviaEmail->emailConfig();
			$retorno=$this->EnviaEmail->enviaAgora($email);

			return $redirect;
    }
}

?>
