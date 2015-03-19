<?php
class EstatisticasController extends AppController{
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('ajax_add','ajax_js'));
	}
	
	public function ajax_visitas($id=null){
		if($id!=null){
			$this->Estatistica->id=$id;
			if(!$this->Estatistica->exists())throw new NotFoundException(__('Ops! Estatística não encontrada'));
			$retorno=$this->Estatistica->read();
		}else{
			$retorno=$this->Estatistica->find('list',array('fields'=>array('created','ip')));
			$i=0;
			$j=0;
			$key_anterior=null;
			
			$total['label']='Todas as visitas';
			
			foreach($retorno as $key=>$value){
				$i=($key_anterior==$key)?$i++:1;
				$key_anterior=$key;
				$key= strtotime($key);
				
				//o javascript usa milisegundos e o php segundos, portando preciso multiplicar por 1000
				$key=$key*1000;
				
				$total['data'][$j][0]=$key;
				$total['data'][$j][1]=$i;
				$j++;
			}
			
			$json[]=$total;
		}
		$this->Set('retorno',$json);
	}
	
	public function ajax_acessos(){

			$retorno=$this->Estatistica->Acesso->find('all',array('recursive'=>-1));
			
			$this->Set('retorno',$retorno);

	}
	
	public function ajax_add($hash=null,$atual,$anterior='direto'){
		if($this->Estatistica->checkHash($hash)){
			debug('hash certo');
			$estatisticas=array(
				'Estatistica'=>array(
					'ip'=>$this->request->clientIp(),
				),
				'Acesso'=>array(
					array(
						'atual'=>$atual,
						'anterior'=>$anterior,
						'useragent'=>$this->request->header('User-Agent'),
						//'hash'=>$this->Estatistica->geraHash(),
					)
				)
			);
			if($this->Session->check('estatisticas')){
				debug('existe seção');
				$estatisticas['Estatistica']['id']=$this->Session->read('estatisticas');
				$this->Estatistica->saveAll($estatisticas);
			}else{
				$this->Estatistica->create();
				$this->Estatistica->saveAll($estatisticas);
				$estatisticas['Estatistica']['id']=$this->Estatistica->getLastInsertId();
				$this->Session->write('estatisticas',$this->Estatistica->getLastInsertId());
				debug('não existe seção');
			}
		}else{
			debug('hash errado');
		}
		
		$this->render(false);
	}
	
	public function ajax_js(){
		$hash=$this->Estatistica->returnHash();
		$this->Set('hash',$hash);
		$this->response->type(array('javascript' => 'text/javascript'));
		$this->response->type('javascript');
	}
}