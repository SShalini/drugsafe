<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Configuration options for Xero private application
 */
if(ENVIRONMENT == 'production') {
	/******Live*******/
	$config = array(
		'consumer'	=> array(
			'key'		=> 'BSZBYXSASYA89FZKRVWSXE1R9MDCJ3',
			'secret'	=> '0T1TZRMFOSAB8SMDMHQDWJF6DZELWK'
		),
		'certs'		=> array(
			'private'  	=> APPPATH.'certs/privatekey.pem',
			'public'  	=> APPPATH.'certs/publickey.cer'
		),
		'format'    => 'xml'
	);
}elseif(ENVIRONMENT == 'development'){
		/**********Local***********/
	$config = array(
		'consumer' => array(
			'key'    => 'D08TVWTEZXZTGETCEPQRV8FKEEITCF',
			'secret' => 'U4YJGSZH8N26G29EPHD6KYGXGJ5W7L'
		),
		'certs'    => array(
			'private' => APPPATH . 'certs/privatekey.pem',
			'public'  => APPPATH . 'certs/publickey.cer'
		),
		'format'   => 'xml'
	);
}