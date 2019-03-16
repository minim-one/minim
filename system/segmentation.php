<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if(($count_segmentation-1)%$segmentation==0){
	$sites=ceil($count_segmentation/$segmentation)-1;
}else{
	$sites=ceil($count_segmentation/$segmentation);
}
if($current==''||$current==1){
	$previous=$current;
	$count=$count_segmentation;
	if($count>$segmentation){
		$end=$count-$segmentation;
	}else{
		$end=0;
	}
}else{
	$previous=$current-1;
	$count=$count_segmentation-1-($current-1)*$segmentation;
	$end=$count_segmentation-($current-1)*$segmentation-$segmentation;
}
if($current<$sites){
	$next=$current+1;
}else{
	$next=$current;
}
$site_found=true;
if($current<1||$current>$sites){
	if($count==0){
		echo'<article><p>'.translation('There aren\'t any posts').'.</p></article>';
	}else{
		echo'<article><p>'.translation('Page doesn\'t exist').'. <a href="./">'.translation('to the main page').'</a></p></article>';
	}
	$site_found=false;
}
?>
