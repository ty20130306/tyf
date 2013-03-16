<?php

abstract class TyfMapperAbstract {
	protected $_cmdFileDir	= null;
	
	public function __construct($cmdFileDir){
		$this->_cmdFileDir = $cmdFileDir;
	}
	
	abstract public function mapToCmdFile($cmdName);
	
	abstract public function mapToCmdClass($cmdName);
	
	abstract public function mapToActionFunc($actionName);
}

class TyfDefaultMapper extends TyfMapperAbstract {
	public function __construct($cmdFileDir){
		parent::__construct($cmdFileDir);
	}
	
	/**
	 * map to cmd file
	 * @param  $cmd
	 * 
	 * eg .
	 * 	intput: testCmdName 
	 * 	output: dir/test_cmd_name.php
	 * 
	 */
	public function mapToCmdFile($cmdName){
		return $this->_cmdFileDir . '/'. preg_replace('/([A-Z])+/e', '"_".strtolower("${1}")', $cmdName) . '.php';
	}
	
	/**
	 * map to cmd class
	 * @param $cmdName
	 * 
	 * eg .
	 * intput: testCmdName 
	 * output: TyfCmd_TestCmdName
	 */
	public function mapToCmdClass($cmdName){
		return 'TyfCmd_' . ucfirst($cmdName);
	}
	
	/**
	 * map to action function
	 * @param $action
	 * 
	 * eg .
	 * intput: testActionName 
	 * output: ActionTestActionName
	 */
	public function mapToActionFunc($actionName){
		return 'Action_' . ucfirst($actionName);
	}
}
