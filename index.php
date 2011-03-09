<?php
/**
* @license
* Noscript logger
*
* Copyright (c) 2011 Boomworks <http://boomworks.com.au/>
* Author: Lindsay Evans
* Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
*/


// Type of resonse to send back
// - 'no response': returns a '204 No Content' header & no body (0B)
// - 'gif': returns a non-cachable 1x1 transparent GIF (43B)
$response_type = 'no response';

// Default file to log to
$log_file = 'noscript.log';

// Format of the log file (same as Apache Combined)
$log_format = "%s - - %s \"%s\" %d %d \"%s\" \"%s\"\n";

// Stick in a domain specific log file if supplied with a domain argument
if(array_key_exists('domain', $_GET)){
	$log_file = 'noscript.' . $_GET['domain'] . '.log';
}

// Open log file & lock
$fp = fopen($log_file, 'a');
if($fp && flock($fp, LOCK_EX | LOCK_NB)){

	// Write details to log file
	$log_line = sprintf($log_format, 
		$_SERVER['REMOTE_ADDR'],
		date('[d/M/Y:H:i:s O]'),
		'GET ' . $_SERVER['REQUEST_URI'] . ' '. $_SERVER['SERVER_PROTOCOL'],
		200,
		43,
		$_SERVER['HTTP_REFERER'],
		$_SERVER['HTTP_USER_AGENT']
	);

	fwrite($fp, $log_line);

	// Release lock
	flock($fp, LOCK_UN);
}
// Close log file
fclose($fp);

if($response_type == 'no response'){
	// Send '204 No Content' response
	header('HTTP/1.0 204 No Content');
}else{
	// Output 1px transparent gif
	header('Content-type: image/gif');
	header('Expires: Fri, 24 Jan 2042 12:34:56 GMT');
	header('Cache-Control: no-cache');
	header('Cache-Control: must-revalidate');
	printf ("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c",71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);
}

exit(0);

