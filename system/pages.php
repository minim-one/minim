<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
$pages=array();
if($path=opendir('./pages/')){
	while(false!==($file=readdir($path))){
		if($file!='.'&&$file!='..'&&is_file('./pages/'.$file)){
			$pages[]=$file;
		}
	}
	closedir($path);
}
if(count($pages)>0){
	sort($pages);
	array_unshift($pages,'');
}
?>
