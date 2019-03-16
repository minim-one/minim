<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if($language=='de'){
	$translation=array(
		'Back'=>'Zurück',
		'Continue reading'=>'Weiterlesen',
		'Page doesn\'t exist'=>'Seite existiert nicht',
		'Post doesn\'t exist'=>'Eintrag existiert nicht',
		'There aren\'t any posts'=>'Es sind keine Einträge vorhanden',
		'To the main page'=>'Zur Startseite'
	);
}
if($language=='en'){
	$translation=array(
		'Back'=>'Back',
		'Continue reading'=>'Continue reading',
		'Page doesn\'t exist'=>'Page doesn\'t exist',
		'Post doesn\'t exist'=>'Post doesn\'t exist',
		'There aren\'t any posts'=>'There aren\'t any posts',
		'To the main page'=>'To the main page'
	);
}
function translation($phrase){
	global $translation;
	if(isset($translation[$phrase])){
		return $translation[$phrase];
	}else{
		return $phrase;
	}
}
?>
