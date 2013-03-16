<?php

class TyfCmdException extends Exception{

}

class TyfCmd{
	protected $_output = array();
	protected $_tyfOutputMeta = null;
	
	protected function checkInput(array $input){
		$args = func_get_args();

		$param = array_slice($args, 1);
		foreach($param as $key){
			if( ! isset($input[$key])){
				throw new TyfCmdException("tyf cmd action input check fail, no key {$key}");
			}
		}
	}
	
	public function initTyfOutputMeta($cmdName, $actionName){
		$this->_tyfOutputMeta = new TyfMeta($cmdName, $actionName, array());
	}
	
	public function getTyfOutputMeta(){
		$this->_tyfOutputMeta->setData($this->_output);
		return $this->_tyfOutputMeta;
	}
}

