<?php

require_once __DIR__ . '/meta.php';
require_once __DIR__ . '/formater.php';
require_once __DIR__ . '/mapper.php';
require_once __DIR__ . '/cmd.php';

class TyfException extends Exception{

}

class Tyf{
	
	protected $_formater	= null;
	protected $_mapper		= null;
	
	public function __construct(TyfMapperAbstract $mapper, TyfFormaterAbstract $formater = null){
		$this->_mapper		= $mapper;
		if($formater == null){
			$this->_formater	= new TyfDefaultFormater();
		} else {
			$this->_formater	= $formater;
		}
	}
	
	public function run(array $rawDataArr){	
		// step 1. process input
		$tyfInputMetaArr = $this->_formater->formatInput($rawDataArr);
		
		// step 2. execute
		$tyfOutputMetaArr = array();
		$len = count($tyfInputMetaArr);
		
		for($i = 0; $i < $len; ++$i){
			$tyfOutputMetaArr[] = $this->execute($tyfInputMetaArr[$i]);
		}
		
		// step 3. process output
		$output = $this->_formater->formatOutput($tyfOutputMetaArr);
		
		return $output;
	}

	protected function execute(TyfMeta $tyfInputMeta){
		$cmdFile = $this->_mapper->mapToCmdFile($tyfInputMeta->getCmdName());
		$this->requireFile($cmdFile);
		
		$cmdClass	= $this->_mapper->mapToCmdClass($tyfInputMeta->getCmdName());
		if(! class_exists($cmdClass)){
			throw new TyfException("tyf cmd class ".$cmdClass." not exists in file ".$cmdFile);
		}
		
		$actionFunc	= $this->_mapper->mapToActionFunc($tyfInputMeta->getActionName());
		
		$cmdObj		= new $cmdClass();
		$cmdObj->initTyfOutputMeta($tyfInputMeta->getCmdName(), $tyfInputMeta->getActionName());
		$cmdObj->$actionFunc($tyfInputMeta->getData());
		$tyfOutputMeta = $cmdObj->getTyfOutputMeta();
		
		return $tyfOutputMeta;
	}
	
	protected function requireFile($cmdFile){
		if( ! file_exists($cmdFile)){
			throw new TyfException("tyf cmd file not exists, file=".$cmdFile);
		}
		
		require_once $cmdFile;
	}
}

