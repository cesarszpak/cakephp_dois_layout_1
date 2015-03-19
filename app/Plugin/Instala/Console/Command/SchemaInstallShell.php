<?php

App::uses('SchemaShell', 'Console/Command');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
App::uses('CakeSchema', 'Model');

class SchemaInstallShell extends SchemaShell {
	public function instala() {
		list($Schema, $table) = $this->_loadSchema();
		$this->_instala($Schema, $table);
	}
	
	protected function _instala(CakeSchema $Schema, $table = null) {
		$db = ConnectionManager::getDataSource($this->Schema->connection);


		if (!$table) {
			foreach ($Schema->tables as $table => $fields) {
				$create[$table] = $db->createSchema($Schema, $table);
			}
		} elseif (isset($Schema->tables[$table])) {
			$create[$table] = $db->createSchema($Schema, $table);
		}
		if (empty($create)) {
			$this->out(__d('cake_console', 'Schema is up to date.'));
			$this->_stop();
		}

		$this->_run($create, 'create', $Schema);
		
	}
	
	public function checkInstalacao() {
		$options['models']=false;
		list($Schema, $table) = $this->_loadSchema();
		foreach($Schema->tables as $key=>$value){
			$tables[]=$key;
		}
		return $tables;
	}
}