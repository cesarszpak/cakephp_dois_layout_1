<?php
class EnviaEmail extends AppShell {
    public $uses = array('EnviaEmail','Configuracao');
    public function main() {
        $emails=$this->EnviaEmail->find('all',array(
			'conditions'=>array('enviado'=>0),
			'order'=>array('created'),
			'limit'=>10,
		));
		
        $this->EnviaEmail->emailConfig();
	
        foreach($emails as $value){
                $retorno=$this->EnviaEmail->enviaAgora($value);
                $this->EnviaEmail->id=$retorno['id'];
                if($retorno['status']){
                        $this->EnviaEmail->set(array('enviado'=>1));
                }else{
                        $this->EnviaEmail->set(array('erro'=>1));
                }
                $this->EnviaEmail->save();
        }
    }
}