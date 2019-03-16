<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if(preg_match('/\?page-*/',$_SERVER['REQUEST_URI'])){
	$category='page';
	include('./system/pages.php');
	$page=explode('?',$_SERVER['REQUEST_URI']);
	$page=substr(urldecode($page[1]),5);
	if(!in_array($page,$pages)){
		require_once('./system/header.php');
		echo'<article><p>'.translation('Page doesn\'t exist').'. <a href="./">'.translation('To the main page').'</a></p></article>';
	}else{
		$post=$page;
		include('./system/content.php');
		require_once('./system/header.php');
		echo'<article>';
		echo markdown($content);
		echo'</article>';
	}
	require_once('./system/footer.php');
}
?>
