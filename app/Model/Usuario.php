<?php
App::uses('Security', 'Utility');
class Usuario extends AppModel {
	public $name = 'Usuario';
	public $actsAs = array('EnviaEmails');
	
    public $validate = array(
		'nome' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O nome não pode ficar em branco!'
            ),
			'unico' => array(
                'rule' => array('minLength',3),
                'message' => 'Nome muito curto!'
            )
        ),
		'sobrenome' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O sobrenome não pode ficar em branco!'
            ),
			'unico' => array(
                'rule' => array('minLength',3),
                'message' => 'Sobrenome muito curto!'
            )
        ),
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O usuário não pode ficar em branco!'
            ),
			'unico' => array(
                'rule' => array('isUnique'),
                'message' => 'Este usuário já tem dono, tente outro!'
            )
        ),
		'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O email não pode ficar em branco!'
            ),
			'unico' => array(
                'rule' => array('isUnique'),
                'message' => 'Este email já está sendo usado!'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A senha é obrigatória!'
            ),
			'minimo' => array(
                'rule' => array('minLength',6),
                'message' => 'A senha é muito curta, o mínimo são 6 caracteres!'
            )
        ),
		'confirma' => array(
			'required' => array(
                'rule' => array('passwordconfirm','password'),
                'message' => 'A senha de confirmação é diferente da sua senha escolhida!'
            )
		)
    );
	public function passwordconfirm($data, $controlField) {
		if (!isset($this->data[$this->alias][$controlField])) {
			trigger_error('O campo de comparação de senha não foi enviado');
			return false;
		}
		$field = key($data);
		$password = current($data);
		$controlPassword = $this->data[$this->alias][$controlField];
		
		if ($password !== $controlPassword) {
			$this->invalidate($controlField, 'Repita a senha!');
			return false;
		}
		return true;
	}
	
	//outras funções
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$hash = Security::hash($this->data[$this->alias]['password'], 'blowfish');
                        $this->data[$this->alias]['password'] = $hash;
		}
		return true;
	}
	
	public function geraSenha($options=array())
	{
		$lmin = 'abcdefghijkmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
		$num = '234567892345678923456789';
		$simb = '!@#$%*-!@#$%*-!@#$%*-';
		$retorno = '';
		$caracteres = '';
		
		$options['minusculas']=(isset($options['minusculas']))?$options['minusculas']:true;
		$options['maiusculas']=(isset($options['maiusculas']))?$options['maiusculas']:true;
		$options['numeros']=(isset($options['numeros']))?$options['numeros']:true;
		$options['simbolos']=(isset($options['simbolos']))?$options['simbolos']:true;
		$options['tamanho']=(isset($options['tamanho']))?$options['tamanho']:15;
	
		if ($options['minusculas']) $caracteres .= $lmin;
		if ($options['maiusculas']) $caracteres .= $lmai;
		if ($options['numeros']) $caracteres .= $num;
		if ($options['simbolos']) $caracteres .= $simb;
	
		$len = strlen($caracteres);
		for ($n = 1; $n <= $options['tamanho']; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}

}