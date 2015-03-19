<?php

class DicasBehavior extends ModelBehavior {
	public function geraHash(Model $Model, $options=array())
	{
		$lmin = 'abcdefghijkmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
		$num = '234567892345678923456789';
		$simb = '!@#$%*-!@#$%*-!@#$%*-';
		$retorno = '';
		$caracteres = '';

		if(count($options)) extract($options);

		if (!isset($tamanho)){
				$tamanho=15;
		}
		if (!isset($minusculas)){ 
				$caracteres .= $lmin;
		}else{
				if($minusculas) $caracteres .= $lmin;
		}
		if (!isset($maiusculas)){ 
				$caracteres .= $lmai;
		}else{ 
				if($maiusculas) $caracteres .= $lmai;
		}
		if (!isset($numeros)){ 
				$caracteres .= $num;
		}else{ 
				if($numeros) $caracteres .= $num;
		}
		if (!isset($simbolos)){ 
				$caracteres .= $simb;
		}else{ 
				if($simbolos) $caracteres .= $simb;
		}

		if((isset($minusculas))&&(isset($maiusculas))&&(isset($numeros))&&(isset($simbolos))){
			if((!$minusculas)&&(!$maiusculas)&&(!$numeros)&&(!$simbolos)) return null;
		}

		$len = strlen($caracteres);
		for ($i = 1; $i <= $tamanho; $i++) {
				$rand = mt_rand(1, $len);
				$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
    }
}