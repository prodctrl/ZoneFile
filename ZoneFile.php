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
}

?>