<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
$posts=array();
if($path=opendir('./posts/')){
	while(false!==($file=readdir($path))){
		if($file!='.'&&$file!='..'&&is_file('./posts/'.$file)){
			$posts[]=$file;
		}
	}
	closedir($path);
}
if(count($posts)>0){
	sort($posts);
	array_unshift($posts,'');
}
?>
