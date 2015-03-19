<?php

class Estatistica extends AppModel{
	public $actsAs = array('Dicas');
	public $hasMany = 'Acesso';
	
	public function checkHash($hash){
		$this->Config=ClassRegistry::init('Config');
		$Config=$this->Config->find('first');
		$Config=$Config['Config'];
		if($hash==$Config['estHash']) return true;
		return false;
	}
	
	public function returnHash(){
		$this->Config=ClassRegistry::init('Config');
		$Config=$this->Config->find('first');
		$Config=$Config['Config'];
		return $Config['estHash'];
	}
	
}