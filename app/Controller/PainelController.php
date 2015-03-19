<?php
class PainelController extends AppController {
	public function admin_home(){
		$this->set('atual',Router::url());
		$this->set('referer',$this->referer());
		$this->set('useragent',$this->request->header('User-Agent'));
		$this->set('ip',$this->request->clientIp());
	}
}