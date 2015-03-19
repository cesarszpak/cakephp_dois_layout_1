<?php
App::uses('CakeSession', 'Model/Datasource');
class EnviaEmail extends AppModel{
    public $Session;

    public $useTable='envia_emails';
    public $validate = array(
        'nome' => array(
            'minimo' => array(
                'rule'    => array('minLength', '3'),
                'message'  => 'Será que existe um nome assim? Tente novamente.'
            ),
                        'obrigatorio'=>array(
                                'rule' => 'notEmpty',
                'message'  => 'O seu nome não pode ficar em branco.'
                        )
        ),
                'de' => array(
            'email' => array(
                'rule'    => array('email', true),
                'message'  => 'Você precisa informar um email que existe.'
            ),
                        'obrigatorio'=>array(
                                'rule' => 'notEmpty',
                'message'  => 'O seu email não pode ficar em branco.'
                        )
        ),
                'para' => array(
            'email' => array(
                'rule'    => array('email', true),
                'message'  => 'Você precisa informar um email que existe.'
            ),
                        'obrigatorio'=>array(
                                'rule' => 'notEmpty',
                'message'  => 'O email de quem vai recebar a mensagem não pode ficar em branco.'
                        )
        ),
                'assunto' => array(
                        'obrigatorio'=>array(
                                'rule' => 'notEmpty',
                'message'  => 'O assunto não pode ficar em branco.'
                        )
        ),
                'mensagem' => array(
            'minimo' => array(
                'rule'    => array('minLength', '5'),
                'message'  => 'Mensagem muito curta, se esforce para acrescentar mais alguma coisa.'
            ),
                        'obrigatorio'=>array(
                                'rule' => 'notEmpty',
                'message'  => 'A mensagem não pode ficar em branco.'
                        )
        ),
    );

    public function emailConfig(){
        App::uses('CakeEmail', 'Network/Email');
        $this->CakeEmail = new CakeEmail();
        
        $this->Session = new CakeSession();
        $configs=$this->Session->read('Configuracao');

        if($configs['email_envio']){

                if(empty($configs['email_host']))$configs['email_host']='localhost';
                if(empty($configs['email_port']))$configs['email_port']=25;
                if(empty($configs['email_timeout']))$configs['email_timeout']=30;
                if(empty($configs['email_username']))$configs['email_username']='user';
                if(empty($configs['email_password']))$configs['email_password']='secret';
                if(empty($configs['email_client']))$configs['email_client']=null;

                $smtp = array(
                        'transport' => 'Smtp',
                        'host' => $configs['email_host'],
                        'port' => $configs['email_port'],
                        'timeout' => $configs['email_timeout'],
                        'username' => $configs['email_username'],
                        'password' => $configs['email_password'],
                        'client' => $configs['email_client'],
                        'log' => false,
                        //'charset' => 'utf-8',
                        //'headerCharset' => 'utf-8',
                );

                $this->CakeEmail->config($smtp);
        }
    }

    public function enviaAgora($email=array()){
        $this->CakeEmail->from(array($email['EnviaEmail']['de'] => $email['EnviaEmail']['nome']))
            ->to($email['EnviaEmail']['para'])
            ->subject($email['EnviaEmail']['assunto']);
        if(empty($email['EnviaEmail']['formato'])){
            $this->CakeEmail->emailFormat('both');
        }else{
            $this->CakeEmail->emailFormat($email['EnviaEmail']['formato']);
        }
        if(!empty($email['EnviaEmail']['template'])){
            $layout=(!empty($email['EnviaEmail']['layout']))?$email['EnviaEmail']['layout']:'default';
            $this->CakeEmail->template($email['EnviaEmail']['template'],$layout);
        }

        $retorno['id'] = isset($email['EnviaEmail']['id'])?$email['EnviaEmail']['id']:null;

        if($this->CakeEmail->send($email['EnviaEmail']['mensagem'])){
            $retorno['status']=true;
        }else{
            $retorno['status']=false;
        }
        return $retorno;
    }
}