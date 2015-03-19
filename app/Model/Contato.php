<?php

class Contato extends AppModel{
	
	public $useTable=false;
    public $actsAs = array('EnviaEmails');
	
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
		'telefone' => array(
            'minimo' => array(
                'rule'    => '/^[\(\)\+\- 0-9]{8,}$/i',
                'message'  => 'Tem certeza que isso é um número de telefone?'
            ),
			'obrigatorio'=>array(
				'rule' => 'notEmpty',
                'message'  => 'O seu telefone não pode ficar em branco.'
			)
        ),
		'email' => array(
            'minimo' => array(
                'rule'    => array('email', true),
                'message'  => 'Você precisa informar um email que existe.'
            ),
			'obrigatorio'=>array(
				'rule' => 'notEmpty',
                'message'  => 'O seu email não pode ficar em branco.'
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
        )
    );
	
	public function editor(){
		
		$retorno=array(
			'linha'=>false,
			'coluna'=>false,
			'apaga'=>false,
			'ckeditor'=>false,
		);
		
		return $retorno;
	}
}