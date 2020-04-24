<?php

class ZoneFile {
	private $domain = 'example.com.';
	private $ttl = 60;
	private $records = [];
	private $strlen_maxes = [
		'name' => 0,
		'ttl' => 0,
		'class' => 0,
		'type' => 0
	];


	public function __construct($domain=NULL, $ttl=NULL){
		if( !is_null($domain) ) $this->domain = $domain;
		if( !is_null($ttl) ) $this->ttl = $ttl;
	}


	private function addRecord($name, $ttl, $class, $type, $data){
		$this->records[] = [
			'name' => $name,
			'ttl' => $ttl,
			'class' => $class,
			'type' => $type,
			'data' => $data
		];
	}


	private function calculateStrlenMaxes(){
		foreach($this->records as $record){
			foreach(['name', 'ttl', 'class', 'type'] as $key){
				$len = strlen($record[$key]);

				if( $len>$this->strlen_maxes[$key] ){
					$this->strlen_maxes[$key] = $len;
				}
			}
		}
	}


	private function pad($input, $max_len){
		$pad = 1; //The number of extra tabs padding
		$chars_per_tab = 8;

		$max_chars = (
			ceil($max_len/$chars_per_tab) + $pad
		) * $chars_per_tab;

		$tabs_needed = ceil(
			(
				$max_chars-strlen($input)
			)/$chars_per_tab
		);

		return $input . str_repeat("\t", $tabs_needed);
	}
}

?>