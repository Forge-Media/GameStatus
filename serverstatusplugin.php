<?PHP
chdir(dirname(__FILE__));
/*-------SETTINGS-------*/
$file = 'serverstatus.json'; #Simple json file stores the array

//Get latest details from json file
if (file_exists($file)) {
	if (filesize($file) !== 0) {
		$servers_array = json_decode(file_get_contents($file),true);
	}
} else {
	echo '<h2 class="status-error"> Server Listings Empty!</h2>';
}

//Use for debugging
//GetAllServers();
//GetServers('csgo');

function GetServers($atts) {
	global $servers_array;

	// Attributes
	extract( shortcode_atts(
		array(
			'game' => 'all',
		), $atts )
	);

	if ($servers_array) {
		DisplayServers ($servers_array, $game);
	}
}

function DisplayServers($array, $gamename) {
	echo '<table class="status-table">';
	echo '<tr><th>Server Name</th><th>IP</th><th>Port</th><th>Status</th><th>Connect</th></tr>';
	if ($gamename == 'all') {
		foreach ($array as $row) { 
			echo '<tr>';
	        echo '<td>' . $row['name'] . '</td>';
	        echo '<td>' . $row['ip'] . '</td>';
	        echo '<td>' . $row['port'] . '</td>';
	       	echo SetStatus($row['status']);
	        echo SetButton($row['status'],$row['ip'],$row['port']);
	        echo '</tr>';
    	}	
	} else {
		foreach ($array as $row) {
			if ($row['game'] == $gamename) {
				echo '<tr>';
		        echo '<td>' . $row['name'] . '</td>';
		        echo '<td>' . $row['ip'] . '</td>';
		        echo '<td>' . $row['port'] . '</td>';
		        echo SetStatus($row['status']);
		        echo SetButton($row['status'],$row['ip'],$row['port']);
		        echo '</tr>';	
			}
    	}	
	}
	echo '</table><br />';
}

function SetStatus($status) {
	if ($status == 'Online') {
		$output = '<td class="status-up"><i class="fa fa-check-circle status-up"></i>'.$status.'</td>';
	} else {
		$output = '<td class="status-down"><i class="fa fa-times-circle status-down"></i></i>'.$status.'</td>';
	}
	return $output;
}

function SetButton($status, $ip, $port) {
	if ($status == 'Online') {
			$output = '<td><a class="fgn-button nectar-button small accent-color regular-button" href="steam://connect/'.$row['ip'].':'.$row['port'].'" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff" style="visibility: visible;"><span>CONNECT</span></a></td>';
		} else {
			$output = '<td><a class="fgn-button nectar-button small extra-color-3 regular-button" href="#" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff" style="visibility: visible;"><span>MAYBE LATER</span></a></td>';
		}
		return $output;
}
/*
	include(WP_CONTENT_DIR . '/scripts/tsinfo.php');
	add_shortcode( 'GetOnlineClients_sc', 'GetOnlineClients' );
	add_shortcode( 'GetOnlineChannels_sc', 'GetOnlineChannels' );
	add_shortcode( 'GetPing_sc', 'GetPing' );
	add_shortcode( 'GetUptime_sc', 'GetUptime' );
*/
?>