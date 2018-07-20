<?php

Class Config{
	Public $id = '';
	Public $secret = '';
	Public $server = "TeamViewer";
	Public $redirect_uri;
	Public $debug = false;
	Public $debug_http = true;
	Public $base_url;

	public function __construct(){
		$this->redirect_uri  = 'http://'.$_SERVER['HTTP_HOST'].dirname(strtok($_SERVER['REQUEST_URI'],'?'))."/login.php";
		$this->base_url = 'http://'.$_SERVER['HTTP_HOST'].dirname(strtok($_SERVER['REQUEST_URI'],'?'));
	}	
}