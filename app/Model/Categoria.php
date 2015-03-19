<?php

class Categoria extends AppModel{
	public $actsAs = array('Tree');
	public $hasAndBelongsToMany  = array('Galeria');
	public $validate = array(
        'titulo' => array(
            'unico' => array(
                'rule'     => 'isUnique',
                'message'  => 'Já existe uma categoria com este nome, escolha outro.'
            ),
			'obrigatorio'=>array(
				'rule' => 'notEmpty',
                'message'  => 'O título da categoria não pode ficar em branco.'
			)
        )
    );
	
	//funções
	public function beforeSave($options = array()) {
		if(isset($this->data['Categoria']['titulo'])){
			if (!isset($this->data['Categoria']['title'])||empty($this->data['Categoria']['title']))
				$this->data['Categoria']['title']=$this->data['Categoria']['titulo'];
				
			if (!isset($this->data['Categoria']['slug'])||empty($this->data['Categoria']['slug'])){
				$this->data['Categoria']['slug']=Inflector::slug(strtolower($this->data['Categoria']['titulo']),'-');
			}else{
				$this->data['Categoria']['slug']=Inflector::slug(strtolower($this->data['Categoria']['slug']),'-');
			}
				
			if (!isset($this->data['Categoria']['habilitar']))
				$this->data['Categoria']['habilitar']=1;
		}
			
		return true;
	}
}