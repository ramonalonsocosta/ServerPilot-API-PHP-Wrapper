<?php

namespace ServerPilot\Resources;

// load main Transport class for extending
require_once 'Resource.php';

// now use it
use ServerPilot\Resources\Resource;

class SystemUsers extends Resource
{
    protected function request($object_id=null, $data=array()) {
    	$path = '/sysusers';
    	
    	if(!is_null($object_id)) {
	    	$path .= '/' . $object_id;
    	}
    
	    return parent::request($path, $data);
    }
    
	public function listAll($server_id=null) {
		$results = $this->request();
		
		if(!is_null($server_id)) {
			foreach($results->data as $key => $result) {
				if($result->serverid != $server_id) unset($results->data[$key]);
			}
		}
		
		return $results;
	}
	
	public function create($serverid, $username, $password) {
	
		$data = array(
			'serverid'	=>	$serverid,
			'name'		=>	$username,
			'password'	=>	$password,
		);
	
		$results = $this->request(null, $data);
		
		return $results;
	}
}