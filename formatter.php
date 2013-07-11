<?php

abstract class TyfFormatterAbstract{
	public function formatInput(array $rawDataArr){
		$len	= count($rawDataArr);
		$tyfMetaArr	= array();
		for($i = 0; $i < $len; ++$i){
			$tyfMetaArr[] = $this->createTyfMeta($rawDataArr[$i]);
		}
		
		return $tyfMetaArr;
	}
	
	public function formatOutput(array $tyfMetaArr){
		$len	= count($tyfMetaArr);
		$output	= array();
		for($i = 0; $i < $len; ++$i){
			$output[] = $this->parseTyfMeta($tyfMetaArr[$i]);
		}
		
		return $output;
	}
	
	abstract protected function createTyfMeta($rawData);
	abstract protected function parseTyfMeta($tyfMeta);
	
}

class TyfDefaultFormatter extends TyfFormatterAbstract{
	
	protected function createTyfMeta($rawData){
		return new TyfMeta($rawData['cmd'], $rawData['action'], $rawData['data']);
	}
	
	protected function parseTyfMeta($tyfMeta){
		return array(	'cmd'		=> $tyfMeta->getCmdName(),
						'action'	=> $tyfMeta->getActionName(),
						'data'		=> $tyfMeta->getData());
	}
}
