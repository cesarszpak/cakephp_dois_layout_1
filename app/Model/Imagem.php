<?php

class Imagem extends AppModel{
	
	public $actsAs = array('Tree','Containable');
	public $hasAndBelongsToMany  = 'Galeria';
	public $validate = array(
        'titulo' => array(
			'obrigatorio'=>array(
				'rule' => 'notEmpty',
                'message'  => 'O título da galeria não pode ficar em branco.'
			)
        ),
		'url' => array(
			'obrigatorio'=>array(
				'rule' => 'notEmpty',
                'message'  => 'Você tem que escolher a imagem.'
			)
        )
    );
	
	//funções
	public function beforeSave($options = array()) {
		if(isset($this->data['Imagem']['titulo'])){
				
			if (!isset($this->data['Imagem']['habilitar']))
				$this->data['Imagem']['habilitar']=1;
		}
			
		return true;
	}
}