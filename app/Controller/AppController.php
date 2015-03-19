<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array(
			'AclControl',
			'Cms',
            'Session',
            'Cookie',
            'Auth' => array(
                'loginAction'=>array(
                        'controller'=>'Usuarios',
                        'action'=>'login'
                ),
                'authenticate'=>array(
                        'Blowfish'=>array(
                                'userModel' => 'Usuario',
                                'scope'=>array('ativo'=>true)
                        )
                ),
                'loginRedirect' => '/admin',
                'logoutRedirect' => '/admin'
            ),
            'Acl',
	);
	
	public $helpers = array(
		'Link' => array('className' => 'Link'),
		'Html' => array('className' => 'BootstrapHtml'),
		'Form' => array('className' => 'BootstrapForm'),
		'Paginator' => array('className' => 'BootstrapPaginator'),
	);
        
    public $permissoes=array();
	
	public function beforeFilter(){
		$this->loadModel('Configuracao');
		
		$configs=$this->Configuracao->find('first');
		
		date_default_timezone_set($configs['Configuracao']['timezone']);
		
		$this->Session->write('Configuracao',$configs['Configuracao']);
                
		$this->set('permissoes',$this->AclControl->setaPermicao());
		
		$this->AclControl->checaPermicao();
	}
	
	public function beforeRender(){
		//define Temas e Layout para o sistema
		if(isset($this->request->params['prefix'])){
			if($this->request->params['prefix']=='admin') $this->layout='default';
			if($this->request->params['prefix']=='ajax') $this->layout='ajax';
			if($this->request->params['prefix']=='cms') $this->layout='cms';
		}else{
			$this->set('configs',$this->Session->read('Configuracao'));
			
			$this->theme=Configure::read('theme');
		}
		if($this->request->is('ajax')){
			$this->layout='ajax';
		}
		$this->set('user',$this->Auth->User());
		$this->set('active','home');
	}
        
	/* SUPORTE 
	protected function __returnAcos($controller){
		$value=str_replace('Controller','',$controller);
		$aco=Inflector::humanize(Inflector::underscore($controller));
		return $aco;
	}*/
        
        
}
