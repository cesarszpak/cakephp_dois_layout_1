<?php

App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('LinkHelper', 'View/Helper');

class LinkHelperTest extends CakeTestCase {
    
    public $menus1=array(
        array(
            'Pagina' =>array(
                'id' => '1',
                'titulo' => 'O Desenvolvedor',
                'corpo' => '
        <div class="row"><div class="span12"><div class="campo-edita"><p>Produtos, este é o conteúdo!</p></div></div></div>',
                'title' => 'O Desenvolvedor',
                'descricao' => '',
                'tags' => '',
                'slug' => 'o-desenvolvedor',
                'menu' => '1',
                'habilitar' => '1',
                'parent_id' => null,
                'controller' => 'Galerias',
                'lft' => '1',
                'rght' => '2',
                'created' => '2013-06-12 21:30:34',
                'modified' => '2013-07-19 18:01:49'
            )
        )
    );
    
    public function setUp() {
        parent::setUp();
        $Controller = new Controller();
        $View = new View($Controller);
        $this->LinkHelper = new LinkHelper($View);
    }

    public function testMenu() {
        $this->LinkHelper->menu($this->menus1);
    }
}
