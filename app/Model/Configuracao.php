<?php

class Configuracao extends AppModel{
	public $useTable = 'configs';
	
	public function afterFind($results, $primary = false){
		foreach($results as $key=>$value){
			if(isset($value['Configuracao']['fone'])){
				$fone=$value['Configuracao']['fone'];
				
				$fone=str_split($value['Configuracao']['fone']);
				
				if(count($fone)==8){
					$fone=$fone[0].$fone[1].$fone[2].$fone[3].'-'.$fone[4].$fone[5].$fone[6].$fone[7];
				}elseif(count($fone)==10){
					$fone='('.$fone[0].$fone[1].') '.$fone[2].$fone[3].$fone[4].$fone[5].'-'.$fone[6].$fone[7].$fone[8].$fone[9];
				}elseif(count($fone)==12){
					$fone='+'.$fone[0].$fone[1].' ('.$fone[2].$fone[3].') '
					.$fone[4].$fone[5].$fone[6].$fone[7].'-'.$fone[8].$fone[9].$fone[10].$fone[11];
				}elseif(count($fone)==11){
					$fone='('.$fone[0].$fone[1].') '.$fone[2].'.'.$fone[3].$fone[4].$fone[5].$fone[6].'-'.$fone[7].$fone[8].$fone[9].$fone[10];
				}elseif(count($fone)==13){
					$fone='+'.$fone[0].$fone[1].' ('.$fone[2].$fone[3].') '
					.$fone[4].'.'.$fone[5].$fone[6].$fone[7].$fone[8].'-'.$fone[9].$fone[10].$fone[11].$fone[12];
				}else{
					$fone=$value['Configuracao']['fone'];
				}
			}
			if(isset($value['Configuracao']['cel'])){
				$cel=$value['Configuracao']['cel'];
				
				$cel=str_split($value['Configuracao']['cel']);
				
				if(count($cel)==8){
					$cel=$cel[0].$cel[1].$cel[2].$cel[3].'-'.$cel[4].$cel[5].$cel[6].$cel[7];
				}elseif(count($cel)==10){
					$cel='('.$cel[0].$cel[1].') '.$cel[2].$cel[3].$cel[4].$cel[5].'-'.$cel[6].$cel[7].$cel[8].$cel[9];
				}elseif(count($cel)==12){
					$cel='+'.$cel[0].$cel[1].' ('.$cel[2].$cel[3].') '
					.$cel[4].$cel[5].$cel[6].$cel[7].'-'.$cel[8].$cel[9].$cel[10].$cel[11];
				}elseif(count($cel)==11){
					$cel='('.$cel[0].$cel[1].') '.$cel[2].'.'.$cel[3].$cel[4].$cel[5].$cel[6].'-'.$cel[7].$cel[8].$cel[9].$cel[10];
				}elseif(count($cel)==13){
					$cel='+'.$cel[0].$cel[1].' ('.$cel[2].$cel[3].') '
					.$cel[4].'.'.$cel[5].$cel[6].$cel[7].$cel[8].'-'.$cel[9].$cel[10].$cel[11].$cel[12];
				}else{
					$cel=$value['Configuracao']['cel'];
				}
				
				$results[$key]['Configuracao']['fone']=$fone;
				$results[$key]['Configuracao']['cel']=$cel;
			}
		}
		return $results;
	}
	
	public function beforeSave($options = array()){
		 if (!empty($this->data['Configuracao']['fone'])) {
			 $this->data['Configuracao']['fone']=preg_replace("/[^0-9]/", "", $this->data['Configuracao']['fone']);
		 }
		 if (!empty($this->data['Configuracao']['cel'])) {
			 $this->data['Configuracao']['cel']=preg_replace("/[^0-9]/", "", $this->data['Configuracao']['cel']);
		 }
		 return true;
	}
	
}