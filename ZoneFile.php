<?php

class ZoneFile {
	private $domain = 'example.com.';
	private $ttl = 60; //The default TTL, used when one is not specified for a record
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
		$this->records[]=[
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


	//Add an A record
	public function addA($name, $ip, $ttl=NULL){
		if( is_null($ttl) ) $ttl = $this->ttl;
		$this->addRecord($name, $ttl, 'IN', 'A', $ip);
	}


	//Add an AAAA record
	public function addAAAA($name, $ip, $ttl=NULL){
		if( is_null($ttl) ) $ttl = $this->ttl;
		$this->addRecord($name, $ttl, 'IN', 'AAAA', $ip);
	}


	//Add a CNAME record
	public function addCname($name, $cname, $ttl=NULL){
		if( is_null($ttl) ) $ttl = $this->ttl;
		$this->addRecord($name, $ttl, 'IN', 'CNAME', $cname);
	}


	//Add a TXT record
	public function addTxt($name, $data, $ttl=NULL){
		if( is_null($ttl) ) $ttl = $this->ttl;
		$this->addRecord($name, $ttl, 'IN', 'TXT', "\"$data\"");
	}


	//Add a MX record
	public function addMx($name, $pri, $server, $ttl=NULL){
		if( is_null($ttl) ) $ttl = $this->ttl;
		$this->addRecord($name, $ttl, 'IN', 'MX', "$pri $server");
	}


	//Add a NS record
	public function addNs($ns, $ttl=NULL){
		if( is_null($ttl) ) $ttl = $this->ttl;
		$this->addRecord('', $ttl, 'IN', 'NS', $ns);
	}


	//Generates the zone file
	public function output(){
		$this->calculateStrlenMaxes();

		$output = <<<OUTPUT
\$ORIGIN {$this->domain}
\$TTL {$this->ttl}
;{$this->domain}

OUTPUT;

		foreach($this->records as $record){
			$output.=$this->pad($record['name'], $this->strlen_maxes['name']);
			$output.=$this->pad($record['ttl'], $this->strlen_maxes['ttl']);
			$output.=$this->pad($record['class'], $this->strlen_maxes['class']);
			$output.=$this->pad($record['type'], $this->strlen_maxes['type']);
			$output.=$record['data'];
			$output.="\n";
		}

		return $output;
	}
}

?>