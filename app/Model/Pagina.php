<?php

class Pagina extends AppModel{
	public $actsAs = array('Tree');
	public $validate = array(
        'titulo' => array(
            'unico' => array(
                'rule'     => 'isUnique',
				'required'=>'create',
                'message'  => 'Já existe uma página com este nome, escolha outro.'
            ),
			'obrigatorio'=>array(
				'rule' => 'notEmpty',
                'message'  => 'O título da página não pode ficar em branco.'
			)
        )
    );
	
	//funções
	public function beforeSave($options = array()) {
		if(isset($this->data['Pagina']['titulo'])){
			if (!isset($this->data['Pagina']['title'])||empty($this->data['Pagina']['title']))
				$this->data['Pagina']['title']=$this->data['Pagina']['titulo'];
				
			if (!isset($this->data['Pagina']['slug'])||empty($this->data['Pagina']['slug'])){
				$this->data['Pagina']['slug']=strtolower(Inflector::slug($this->data['Pagina']['titulo'],'-'));
			}else{
				$this->data['Pagina']['slug']=strtolower(Inflector::slug($this->data['Pagina']['slug'],'-'));
			}
			if (!isset($this->data['Pagina']['menu']))
				$this->data['Pagina']['menu']=1;
				
			if (!isset($this->data['Pagina']['habilitar']))
				$this->data['Pagina']['habilitar']=1;
		}
			
		return true;
	}
}