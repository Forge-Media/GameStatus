<?php
chdir(dirname(__FILE__));

/*-------SETTINGS-------*/
$input_file = 'serverlist.txt';
$output_file = 'serverstatus.json';

/*-------DON'T EDIT------*/
if (file_exists($input_file) & filesize($input_file) !== 0) {
	pingServers($input_file, $output_file);
} else {
	echo "Error: serverlist.txt either missing or empty!";
}

function pingServers($input, $output) {
	try {
		$servers_array = getServers($input);
		$counter = 0;
		foreach ($servers_array as $value) {
			if (serverStatus($value['ip'], $value['port']) == true) {
				$status = "Online";
			} else {
				$status = "Offline";
			}
			$servers_array[$counter]['status'] = $status;
			$counter++;
		}
		echo "Success: ".$counter." servers pinged!";
		file_put_contents($output, json_encode($servers_array));

	} catch (Exception $e) {
    	echo 'Caught exception: ',  $e->getMessage(), "\n";
	}	
}

function serverStatus($ip, $port) {
	$fp = @fsockopen($ip, $port, $errno, $errstr, 10);
		if (!$fp){
			return false;
		}
		else {
			return true;          
		}
}

function getServers($file) {
	$index = 0;
	$data = file($file, FILE_IGNORE_NEW_LINES);
	foreach ($data as $value) {
		$servers[$index] = explode(':', $value);
		$array[$index] = array('game' => $servers[$index][0], 'name' => $servers[$index][1], 'ip' => $servers[$index][2], 'port' => $servers[$index][3], 'status' => '');
		$index++;
	}
	return $array;
}
?>

