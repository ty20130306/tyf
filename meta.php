<?php

class TyfMeta{
	protected $_cmdName		= '';
	protected $_actionName	= '';
	protected $_data		= null;
	
	public function __construct($cmdName, $actionName, $data){
		$this->_cmdName		= $cmdName;
		$this->_actionName	= $actionName;
		$this->_data		= $data;
	}
	
	public function getCmdName(){
		return $this->_cmdName;
	}
	
	public function getActionName(){
		return $this->_actionName;
	}
	
	public function getData(){
		return $this->_data;
	}
	
	public function setData($data){
		$this->_data = $data;
	}
}
