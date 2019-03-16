<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
require_once('./system/parsedown.php');
require_once('./system/parsedown-extra.php');
function markdown($content){
	$Extra=new ParsedownExtra();
	$parts=preg_split("/(< \s* code .* \/ \s* code \s* >)/Umsxu",$Extra->text($content),-1,PREG_SPLIT_DELIM_CAPTURE);
	foreach($parts as $i=>$part){
    	if($i%2){
			$parts[$i]=str_replace(PHP_EOL,'<br>',$part);
		}
	}
	$content=implode('',$parts);
	return str_replace(PHP_EOL,'',$content);
}
?>
