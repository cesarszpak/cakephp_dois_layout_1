<?php

class Galeria extends AppModel{
	public $actsAs = array('Tree','Containable');
	public $hasAndBelongsToMany  = array('Categoria','Imagem');
	public $validate = array(
        'titulo' => array(
            'unico' => array(
                'rule'     => 'isUnique',
                'message'  => 'Já existe uma galeria com este nome, escolha outro.'
            ),
			'obrigatorio'=>array(
				'rule' => 'notEmpty',
                'message'  => 'O título da galeria não pode ficar em branco.'
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
	
	//funções
	public function beforeSave($options = array()) {
		if(isset($this->data['Galeria']['titulo'])){
			if (!isset($this->data['Galeria']['title'])||empty($this->data['Galeria']['title']))
				$this->data['Galeria']['title']=$this->data['Galeria']['titulo'];
				
			if (!isset($this->data['Galeria']['slug'])||empty($this->data['Galeria']['slug'])){
				$this->data['Galeria']['slug']=Inflector::slug(strtolower($this->data['Galeria']['titulo']),'-');
			}else{
				$this->data['Galeria']['slug']=Inflector::slug(strtolower($this->data['Galeria']['slug']),'-');
			}
				
			if (!isset($this->data['Galeria']['habilitar']))
				$this->data['Galeria']['habilitar']=1;
		}
			
		return true;
	}
}