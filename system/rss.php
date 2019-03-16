<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if(parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY)=='rss'){
	header('content-type:application/rss+xml;charset='.$encoding);
	echo'<?xml version="1.0" encoding="'.$encoding.'"?><rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"><channel><title>'.$title.'</title><link>'.(isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/</link><description>'.$description.'</description><language>'.$language.'</language><atom:link href="'.(isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/?rss" rel="self" type="application/rss+xml"/>';
	include('./system/posts.php');
	if(count($posts)>0){
		require_once('./system/markdown.php');
		if($rss==0||count($posts)-1-$rss<0){
			$limit=0;
		}else{
			$limit=count($posts)-1-$rss;
		}
		for($i=count($posts)-1;$i>$limit;$i--){
			$category='rss';
			$post=$posts[$i];
			include('./system/content.php');
			echo'<item><title>'.$title.' - Post #'.$i.'</title><link>'.(isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/?post-'.$post.'</link><description>'.str_replace(array('<','>','./uploads/'),array('&lt;','&gt;',(isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/uploads/'),markdown($content)).'</description><pubDate>'.date('r',strtotime($post_date)).'</pubDate><guid>'.(isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/?post-'.$post.'</guid></item>';
		}
	}
	echo'</channel></rss>';
}
?>
