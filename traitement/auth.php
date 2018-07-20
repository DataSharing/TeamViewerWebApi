<?php
require('./lib/http.php');
require('./lib/oauth_client.php');
require('./config/config.php');

$config = New Config();
$client = new oauth_client_class;
$client->server = $config->server;
$client->debug = $config->debug;
$client->debug_http = $config->debug_http;
$client->redirect_uri = $config->redirect_uri;

$client->client_id = $config->id; 
$application_line = __LINE__;
$client->client_secret = $config->secret;

if(strlen($client->client_id) == 0
	|| strlen($client->client_secret) == 0)
	die('Please go to TeamViewer applications page '.
		'https://login.teamviewer.com/nav/api create an application '.
		'and in the line '.$application_line.' set the client_id to Client ID '.
		'and client_secret with Client secret.');

	/* API permissions
	 */
	$client->scope = '';
	if(($success = $client->Initialize()))
	{
		if(($success = $client->Process()))
		{
			if(strlen($client->authorization_error))
			{
				$client->error = $client->authorization_error;
				$success = false;
			}
			elseif(strlen($client->access_token))
			{
				
				$success = $client->CallAPI(
					'https://webapi.teamviewer.com/api/v1/devices',
					'GET', array(), array('FailOnAccessError'=>true), $ordinateurs);
				
			}
		}
		$success = $client->Finalize($success);
	}
	if($client->exit)
		exit;
	if(!$success)
	{
?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title>OAuth client error</title>
		</head>
		<body>
		<h1>OAuth client error</h1>
		<pre>Error: <?php echo HtmlSpecialChars($client->error); ?></pre>
	</body>
	</html>
	<?php
	exit;
}else{
	include('./traitement/post.php');
}