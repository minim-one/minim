<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if(!strstr($_SERVER['REQUEST_URI'],'?')||preg_match('/\?site-[0-9]*$/',$_SERVER['REQUEST_URI'])){
	$category='site';
	include('./system/posts.php');
	require_once('./system/header.php');
	$count_segmentation=count($posts);
	if(preg_match('/\?site-[0-9]*$/',$_SERVER['REQUEST_URI'])){
		$current=explode('?',$_SERVER['REQUEST_URI']);
		$current=substr($current[1],5);
	}else{
		$current=1;
	}
	include('./system/segmentation.php');
	if($site_found){
		for($i=$count;$i>=$end;$i--){
			if(isset($posts[$i])&&$i!=0){
				$post=$posts[$i];
				$post_number=array_search($post,$posts);
				include('./system/content.php');
				include('./system/preview.php');
			}
		}
		echo'<section class="sites">';
		if($current!=$previous){
			echo'<a href="./?site-'.$previous.'" class="left">&#9664;</a>';
		}
		echo $current.' / '.$sites;
		if($current!=$next){
			echo'<a href="./?site-'.$next.'" class="right">&#9654;</a>';
		}
		echo'</section>';
	}
	require_once('./system/footer.php');
}
?>
