<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if(isset($addons)){
	for($i=0;$i<count($addons);$i++){
		if(file_exists('./addons/'.$addons[$i])){
			require_once('./addons/'.$addons[$i]);
		}
	}
}
?>
